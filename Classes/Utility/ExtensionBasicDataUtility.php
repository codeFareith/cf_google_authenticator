<?php declare(strict_types=1);
/**
 * Class ExtensionBasicDataUtility
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

namespace CodeFareith\CfGoogleAuthenticator\Utility;

use Throwable;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use function explode;
use function is_array;
use function unserialize;

/**
 * Helper class to fetch basic data of the extension
 *
 * This utility class provides the basic data of the extension.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 * @since   1.0.0
 */
final class ExtensionBasicDataUtility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static function getVendorName(): string
    {
        return explode('\\', __NAMESPACE__)[0];
    }

    public static function getExtensionName(): string
    {
        return explode('\\', __NAMESPACE__)[1];
    }

    public static function getExtensionKey(): string
    {
        return GeneralUtility::camelCaseToLowerCaseUnderscored(
            self::getExtensionName()
        );
    }

    public static function getExtensionConfiguration(): array
    {
        /** @var ExtensionConfiguration $extensionConfiguration */
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        return $extensionConfiguration->get(self::getExtensionKey()) ?? [];
    }
}
