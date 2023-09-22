<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticatorService
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2019 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

use CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility;
use CodeFareith\CfGoogleAuthenticator\Utility\GoogleAuthenticatorUtility;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Log\Logger;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Google Authenticator Service
 *
 * The Google Authenticator Service handles backend login requests.
 * When a user tries to log in, this service checks whether the
 * user has enabled the Google Authenticator.
 * If so, the given code (if any) is validated against the
 * stored secret and on success, the user can proceed.
 * If the user has not enabled the Google Authenticator,
 * the login request is delegated to the default authentication service.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Service
 * @since   1.0.0
 */
class GoogleAuthenticatorService
    implements AuthenticationService
{
    public const
        AUTH_FAIL_AND_STOP = -1,
        AUTH_FAIL_AND_PROCEED = 100,
        AUTH_SUCCEED_AND_PROCEED = 70,
        AUTH_SUCCEED_AND_STOP = 200;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var array
     */
    protected $extConf;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function init(): bool
    {
        $this->extConf = ExtensionBasicDataUtility::getExtensionConfiguration();

        return true;
    }

    public function authUser(array $user): int
    {
        if ((bool) $user['tx_cfgoogleauthenticator_enabled'] === true) {
            if ((bool)$this->extConf['devlog']) {
                static::getLogger()->debug('Frontend login using Google Authenticator', [
                    'username' => $user['username'],
                ]);
            }

            $otp = GeneralUtility::_GP('google-authenticator-otp');
            $secret = $user['tx_cfgoogleauthenticator_secret'];

            if (GoogleAuthenticatorUtility::verifyOneTimePassword($secret, $otp) === true) {
                $status = self::AUTH_SUCCEED_AND_PROCEED;
            } else {
                $status = self::AUTH_FAIL_AND_STOP;
            }
        } else {
            if ((bool)$this->extConf['devlog']) {
                static::getLogger()->debug('Frontend login using TYPO3 password authentication', [
                    'username' => $user['username'],
                ]);
            }

            $status = static::AUTH_FAIL_AND_PROCEED;
        }

        return $status;
    }

    /**
     * Returns a logger.
     *
     * @return LoggerInterface
     */
    private static function getLogger(): LoggerInterface
    {
        /** @var Logger $logger */
        static $logger = null;
        if ($logger === null) {
            $logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
        }
        return $logger;
    }
}
