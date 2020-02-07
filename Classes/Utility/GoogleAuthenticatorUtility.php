<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticatorUtility
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

use DateTimeImmutable;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use function chr;
use function floor;
use function hash_equals;
use function hash_hmac;
use function ord;
use function pack;
use function str_pad;
use function strlen;
use function substr;
use function unpack;

/**
 * Google Authenticator Utility
 *
 * This utility class helps to verify one-time passwords and to check
 * them against a given secret.
 * A discrepancy can also be set to compensate any time differences.
 * Caution: do not set this value too high as it is a safety risk.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 * @since   1.0.0
 */
final class GoogleAuthenticatorUtility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    private const
        OTP_REGENERATION = 30,
        OTP_LENGTH = 6;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public static function verifyOneTimePassword(string $secret, string $otp, int $discrepancy = null): bool
    {
        $discrepancy = $discrepancy ?? 1;
        $return = false;

        if (strlen($otp) === self::OTP_LENGTH) {
            $dateTime = GeneralUtility::makeInstance(DateTimeImmutable::class);
            $timeSlice = floor($dateTime->getTimestamp() / self::OTP_REGENERATION);

            for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
                $checkCode = self::getCheckCode($secret, $timeSlice + $i);

                if (hash_equals($checkCode, $otp)) {
                    $return = true;
                    break;
                }
            }
        }

        return $return;
    }

    private static function getCheckCode(string $secret, float $timeSlice): string
    {
        $secretKey = Base32Utility::decode($secret);

        $pack = pack('N*', $timeSlice);
        $pad = str_pad('', 4, chr(0));
        $time = ($pad . $pack);

        $hash = hash_hmac('SHA1', $time, $secretKey, true);
        $hashSub = substr($hash, -1);
        $offset = ord($hashSub) & 0x0F;
        $hashPart = substr($hash, $offset, 4);

        $unpack = (array) unpack('N', $hashPart);

        $value = $unpack[1] & 0x7FFFFFFF;

        $modulo = 10 ** self::OTP_LENGTH;

        return str_pad(
            (string)($value % $modulo),
            self::OTP_LENGTH,
            '0',
            STR_PAD_LEFT
        );
    }
}
