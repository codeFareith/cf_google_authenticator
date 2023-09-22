<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticationServiceAdapterFactory
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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @package CodeFareith\CfGoogleAuthenticator\Service
 * @since   1.1.5
 */
class GoogleAuthenticationServiceAdapterFactory
    implements AuthenticationServiceAdapterFactory
{
    public function create(): AuthenticationService
    {
        return GeneralUtility::makeInstance(
            $this->suggestServiceAdapter(),
            $this->suggestAuthenticatorService()
        );
    }

    private function suggestServiceAdapter(): string
    {
        return CoreAuthenticationServiceAdapter::class;
    }

    private function suggestAuthenticatorService(): AuthenticationService
    {
        return GeneralUtility::makeInstance(GoogleAuthenticatorService::class);
    }
}
