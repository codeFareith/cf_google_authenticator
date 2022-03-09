<?php declare(strict_types=1);
/**
 * Class PathUtility
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

namespace CodeFareith\CfGoogleAuthenticator\Utility;

use function implode;
use function ltrim;
use function rtrim;
use function vsprintf;

/**
 * Helper class to create extension links
 *
 * This utility provides methods for effortless path generation.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 * @since   1.0.0
 */
final class PathUtility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static $languageDirectoryPath = 'Resources/Private/Language';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static function makePath(string ...$segments): string
    {
        foreach ($segments as &$segment) {
            $segment = self::stripLeadingAndTrailingSlash($segment);
        }
        unset($segment);

        return implode('/', $segments);
    }

    public static function stripLeadingAndTrailingSlash(string $string): string
    {
        return static::stripLeadingSlash(
            static::stripTrailingSlash($string)
        );
    }

    public static function stripLeadingSlash(string $string): string
    {
        return ltrim($string, '/\\');
    }

    public static function stripTrailingSlash(string $string): string
    {
        return rtrim($string, '/\\');
    }

    public static function makeExtensionPath(string $relativePath): string
    {
        $relativePath = self::stripLeadingSlash($relativePath);

        return vsprintf(
            '%s:%s/%s',
            [
                'EXT',
                ExtensionBasicDataUtility::getExtensionKey(),
                $relativePath,
            ]
        );
    }

    public static function makeLocalLangLinkPath(string $id, string $file = null): string
    {
        $file = $file ?? 'locallang.xlf';
        $relativePath = self::makePath(self::$languageDirectoryPath, $file);
        $extensionLink = self::makeExtensionPath($relativePath);

        return vsprintf(
            '%s:%s:%s',
            [
                'LLL',
                $extensionLink,
                $id,
            ]
        );
    }
}
