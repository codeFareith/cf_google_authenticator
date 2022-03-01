<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticatorSettingsMapper
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2022 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Domain\Mapper;

use CodeFareith\CfGoogleAuthenticator\Domain\Struct\GoogleAuthenticatorSettings;

/**
 * Mapper for Google Authenticator settings
 *
 * In some places, the user-specific settings for two-factor authentication
 * can only be obtained in the form of an associative array.
 * The mapper class maps this array to a specific type of object: a Struct.
 * Thus, we benefit from a clean interface and code completion.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Domain\Mapper
 * @since   1.0.0
 */
class GoogleAuthenticatorSettingsMapper
    extends AbstractMapper
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    protected static function mapArrayOnStruct(array $data): GoogleAuthenticatorSettings
    {
        $struct = new GoogleAuthenticatorSettings();

        $struct->setEnabled((bool) $data['tx_cfgoogleauthenticator_enabled']);
        $struct->setSecretKey((string) $data['tx_cfgoogleauthenticator_secret']);

        return $struct;
    }
}
