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

namespace CodeFareith\CfGoogleAuthenticator\Domain\Mapper;

use CodeFareith\CfGoogleAuthenticator\Domain\Struct\GoogleAuthenticatorSettings;

class GoogleAuthenticatorSettingsMapper extends AbstractMapper
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string[] */
    protected static $requiredFields = [];

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    protected static function mapArrayOnStruct(array $data): GoogleAuthenticatorSettings
    {
        $struct = new GoogleAuthenticatorSettings();
        $struct->setEnabled((bool)$data['tx_cfgoogleauthenticator_enable']);
        $struct->setSecretKey((string)$data['tx_cfgoogleauthenticator_secret']);

        return $struct;
    }
}
