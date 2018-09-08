<?php
/**
 * @author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

use CodeFareith\CfGoogleAuthenticator\Utility\GoogleAuthenticatorUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Sv\AbstractAuthenticationService;

/**
 * Google Authenticator Service
 *
 * The Google Authenticator Service handles backend login requests.
 * When a user tries to log in, this service checks wether the
 * user has enabled the Google Authenticator.
 * If so, the given code (if any) is validated against the
 * stored secret and on success, the user can proceed.
 * If the user has not enabled the Google Authenticator,
 * the login request is delegated to the default authentication service.
 *
 * Class GoogleAuthenticatorService
 * @package CodeFareith\CfGoogleAuthenticator\Service
 */
class GoogleAuthenticatorService extends AbstractAuthenticationService
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var array */
    protected $extConf;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function init(): bool
    {
        $extName = \explode('\\', __NAMESPACE__)[1];
        $extKey = GeneralUtility::camelCaseToLowerCaseUnderscored($extName);
        $this->extConf = \unserialize(
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey],
            [
                'allowed_classes' => false
            ]
        );

        return ((bool)$this->extConf['googleAuthenticatorEnable' . TYPO3_MODE]);
    }

    public function authUser(array $user): int
    {
        $status = -1;

        if ((bool)$user['tx_cfgoogleauthenticator_enable'] === true) {
            $this->writeDevLog(
                \vsprintf(
                    '%s login using Google Authenticator for user: %s',
                    [
                        TYPO3_MODE,
                        $user['username']
                    ]
                )
            );

            $otp = GeneralUtility::_GP('google-authenticator-otp');
            $secret = $user['tx_cfgoogleauthenticator_secret'];

            if (GoogleAuthenticatorUtility::verifyOneTimePassword($secret, $otp) === true) {
                $status = 200;
            }
        } else {
            $this->writeDevLog(
                \vsprintf(
                    '%s login using TYPO3 password authentication for user: %s',
                    [
                        TYPO3_MODE,
                        $user['username']
                    ]
                )
            );

            $status = 100;
        }

        return $status;
    }

    private function writeDevLog(string $message): void
    {
        if ((bool)$this->extConf['devlog'] === true) {
            GeneralUtility::devLog(
                $message,
                'tx_cfgoogleauthenticator_sv',
                0
            );
        }
    }
}
