<?php declare(strict_types=1);
/**
 * Class Base32Utility
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

use Exception;
use function bindec;
use function chr;
use function chunk_split;
use function count;
use function explode;
use function ord;
use function preg_replace;
use function random_int;
use function sprintf;
use function str_pad;
use function str_split;
use function strlen;
use function strpos;
use function strtoupper;
use function substr;

/**
 * Base32 encoder / decoder
 *
 * This utility class helps to encode and decode values with Base32.
 * It provides three different standard charsets: RFC4648, CROCKFORD and MIME_09AV.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 * @since   1.0.0
 */
final class Base32Utility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    public const
        RFC4648 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=',
        CROCKFORD = '0123456789ABCDEFGHJKMNPQRSTVWXYZ',
        MIME_09AV = '0123456789ABCDEFGHIJKLMNOPQRSTUV';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @throws Exception
     */
    public static function generateRandomString(int $stringLength, string $charset = null): string
    {
        $charset = $charset ?? self::RFC4648;
        $key = '';

        while (strlen($key) < $stringLength) {
            $index = random_int(0, 31);
            $key .= $charset[$index];
        }

        return $key;
    }

    public static function encode(string $string, string $charset = null): string
    {
        $charset = $charset ?? self::RFC4648;
        $return = '';

        if ($string !== '') {
            $binary = self::convertStringToBinary($string);
            $array = self::convertBinaryToArray($binary);
            $return = self::convertBinariesToBase32($array, $charset);
        }

        return $return;
    }

    public static function decode(string $base32, string $charset = null): string
    {
        $charset = $charset ?? self::RFC4648;
        $sanitizedBase32 = self::sanitizeBase32($base32);
        $return = '';

        if ($sanitizedBase32 !== '') {
            $binaries = self::convertBase32ToBinaries($sanitizedBase32, $charset);
            $return = self::convertBinariesToString($binaries);
        }

        return $return;
    }

    private static function convertStringToBinary(string $string): string
    {
        $chars = str_split($string);

        return self::convertCharsToBinary($chars);
    }

    private static function convertCharsToBinary(array $chars): string
    {
        $result = '';

        foreach ($chars as $char) {
            $result .= self::convertCharToBinary($char);
        }

        return $result;
    }

    private static function convertCharToBinary(string $char): string
    {
        $ord = ord($char);

        return sprintf('%08b', $ord);
    }

    private static function convertBinaryToArray(string $binary): array
    {
        $chunks = self::convertBinaryToChunks($binary, 5);

        return self::arrayPadModulo($chunks, 8, null);
    }

    private static function convertBinaryToChunks(string $binary, int $bits): array
    {
        $chunked = chunk_split($binary, $bits, ' ');
        $length = strlen($chunked);
        $trailing = substr($chunked, $length - 1);

        if ($trailing === ' ') {
            $chunked = substr($chunked, 0, -1);
        }

        return explode(' ', $chunked);
    }

    private static function arrayPadModulo(array $array, int $multiple, $value): array
    {
        while (count($array) % $multiple !== 0) {
            $array[] = $value;
        }

        return $array;
    }

    private static function convertBinariesToBase32(array $binaries, string $charset): string
    {
        $base32 = '';

        foreach ($binaries as $binary) {
            $base32 .= self::getCharFromCharsetByBinary($charset, $binary);
        }

        return $base32;
    }

    private static function getCharFromCharsetByBinary(string $charset, string $binary = null): string
    {
        $index = 32;

        if ($binary !== null) {
            $index = self::convertBinaryToDecimal($binary, 5);
        }

        return $charset[$index];
    }

    private static function convertBinaryToDecimal(string $binary, int $length): int
    {
        $bin = str_pad(
            $binary,
            $length,
            '0'
        );

        return bindec($bin);
    }

    private static function sanitizeBase32(string $base32): string
    {
        $pattern = '/[^A-Z2-7]/';
        $upperBase32 = strtoupper($base32);

        return preg_replace($pattern, '', $upperBase32);
    }

    private static function convertBase32ToBinaries(string $base32, string $charset): array
    {
        $chars = str_split($base32);
        $binary = self::getBinaryFromCharsetByChars($charset, $chars);
        $reduced = self::stringReduceModulo($binary, 8);

        return self::convertBinaryToChunks($reduced, 8);
    }

    private static function getBinaryFromCharsetByChars(string $charset, array $chars): string
    {
        $binary = '';

        foreach ($chars as $char) {
            $binary .= self::getBinaryFromCharsetByChar($charset, $char);
        }

        return $binary;
    }

    private static function getBinaryFromCharsetByChar(string $charset, string $char): string
    {
        $binary = '';
        $index = strpos($charset, $char);

        if ($index !== 32) {
            $binary = sprintf('%05b', $index);
        }

        return $binary;
    }

    private static function stringReduceModulo(string $string, int $multiplier): string
    {
        while (strlen($string) % $multiplier !== 0) {
            $string = substr($string, 0, -1);
        }

        return $string;
    }

    private static function convertBinariesToString(array $binaries): string
    {
        $string = '';

        foreach ($binaries as $binary) {
            $string .= self::convertBinaryToChar($binary);
        }

        return $string;
    }

    private static function convertBinaryToChar(string $binary): string
    {
        $bindec = self::convertBinaryToDecimal($binary, 8);

        return chr($bindec);
    }
}
