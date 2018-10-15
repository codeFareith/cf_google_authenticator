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

final class TypoScriptUtility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string */
    private const INCLUDE_TYPO_SCRIPT_FILE = '<INCLUDE_TYPOSCRIPT: source="FILE:%s">';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static function getIncludeTypoScriptFileTag(string $file): string
    {
        return vsprintf(
            static::INCLUDE_TYPO_SCRIPT_FILE,
            [
                $file
            ]
        );
    }
}
