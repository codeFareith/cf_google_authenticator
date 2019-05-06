<?php
/**
 * Class TypoScriptUtility
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

use function vsprintf;

/**
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 * @since   1.0.0
 */
final class TypoScriptUtility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    private const INCLUDE_TYPO_SCRIPT_FILE = '<INCLUDE_TYPOSCRIPT: source="FILE:%s">';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static function getIncludeTypoScriptFileTag(string $file): string
    {
        return vsprintf(
            static::INCLUDE_TYPO_SCRIPT_FILE,
            [
                $file,
            ]
        );
    }
}
