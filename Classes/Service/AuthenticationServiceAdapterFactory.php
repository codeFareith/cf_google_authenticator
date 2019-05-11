<?php
/**
 * Interface AuthenticationServiceAdapterFactory
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

/**
 * @package CodeFareith\CfGoogleAuthenticator\Service
 * @since   1.1.5
 */
interface AuthenticationServiceAdapterFactory
{
    public function create(): AuthenticationService;
}
