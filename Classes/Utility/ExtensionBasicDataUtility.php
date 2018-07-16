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
namespace CodeFareith\CfGoogleAuthenticator\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Helper class to fetch basic data of the extension
 *
 * This utility class provides the basic data of the extension.
 *
 * Class ExtensionBasicDataUtility
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 */
final class ExtensionBasicDataUtility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static function getVendorName(): string
    {
        return \explode('\\', __NAMESPACE__)[0];
    }

    public static function getExtensionName(): string
    {
        return \explode('\\', __NAMESPACE__)[1];
    }

    public static function getExtensionKey(): string
    {
        return GeneralUtility::camelCaseToLowerCaseUnderscored(
            self::getExtensionName()
        );
    }

    public static function getExtensionConfiguration(): array
    {
        $extensionConfiguration = \unserialize(
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::getExtensionKey()],
            [
                'allowed_classes' => false
            ]
        );

        if(!\is_array($extensionConfiguration)) {
            $extensionConfiguration = [];
        }

        return $extensionConfiguration;
    }
}