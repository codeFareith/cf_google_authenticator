<?php declare(strict_types=1);
/**
 * Interface StructInterface
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

namespace CodeFareith\CfGoogleAuthenticator\Domain\Struct;

use ArrayAccess;

/**
 * Interface for structs
 *
 * @package CodeFareith\CfGoogleAuthenticator\Domain\Struct
 * @since   1.0.0
 */
interface StructInterface
    extends ArrayAccess
{
    public function toArray(bool $boolToInt = null): array;
}
