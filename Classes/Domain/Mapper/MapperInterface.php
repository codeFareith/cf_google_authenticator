<?php declare(strict_types=1);
/**
 * Interface MapperInterface
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

/**
 * Interface definition for mappers
 *
 * @package CodeFareith\CfGoogleAuthenticator\Domain\Mapper
 * @since   1.0.0
 */
interface MapperInterface
{
    public static function hasRequiredFields(array $data): bool;

    public static function getMissingFields(array $data): array;

    public static function createStructFromArray(array $data);
}
