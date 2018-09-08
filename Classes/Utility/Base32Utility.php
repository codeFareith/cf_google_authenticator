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

/**
 * Base32 encoder / decoder
 *
 * This utility class helps to encode and decode values with Base32.
 * It provides three different standard charsets: RFC4648, CROCKFORD and MIME_09AV.
 *
 * Class Base32Utility
 * @package CodeFareith\CfGoogleAuthenticator\Utility
 */
final class Base32Utility
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string */
    public const RFC4648 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=';

    /** @var string */
    public const CROCKFORD = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';

    /** @var string */
    public const MIME_09AV = '0123456789ABCDEFGHIJKLMNOPQRSTUV';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @throws \Exception
     */
    public static function generateRandomString(int $length, string $charset = self::RFC4648): string
    {
        $key = '';

        while (\strlen($key) < $length) {
            $rand = \random_int(0, 31);
            $key .= $charset[$rand];
        }

        return $key;
    }

    public static function encode(string $string, string $charset = self::RFC4648): string
    {
        if ($string === '') {
            return '';
        }

        $binaryString = self::convertStringToBinary($string);
        $binaryArray = self::convertBinaryToArray($binaryString);

        return self::convertArrayToBase32($binaryArray, $charset);
    }

    public static function decode($base32String, string $charset = self::RFC4648): string
    {
        $base32String = self::sanitizeBase32($base32String);

        if ($base32String === '') {
            return '';
        }

        $binaryArray = self::convertBase32ToArray($base32String, $charset);

        return self::convertArrayToString($binaryArray);
    }

    private static function convertStringToBinary(string $string): string
    {
        $binaryString = '';

        foreach (\str_split($string) as $s) {
            $ord = \ord($s);
            $binaryString .= \sprintf('%08b', $ord);
        }

        return $binaryString;
    }

    private static function convertBinaryToArray(string $binaryString): array
    {
        $binaryArray = self::chunk($binaryString, 5);
        $binaryArrayLength = \count($binaryArray);

        while ($binaryArrayLength % 8 !== 0) {
            $binaryArray[] = null;
        }
        return $binaryArray;
    }

    private static function convertArrayToBase32(array $binaryArray, string $charset): string
    {
        $base32String = '';

        foreach ($binaryArray as $bin) {
            $char = 32;

            if ($bin !== null) {
                $bin = \str_pad(
                    $bin,
                    5,
                    0,
                    STR_PAD_RIGHT
                );
                $char = \bindec($bin);
            }

            $base32String .= $charset[$char];
        }

        return $base32String;
    }

    private static function sanitizeBase32(string $base32String): string
    {
        $pattern = '/[^A-Z2-7]/';
        $base32String = \strtoupper($base32String);
        $base32String = \preg_replace($pattern, '', $base32String);

        return $base32String;
    }

    private static function convertBase32ToArray(string $base32String, string $charset): array
    {
        $string = '';
        $base32Array = \str_split($base32String);

        foreach ($base32Array as $str) {
            $char = \strpos($charset, $str);

            if ($char !== 32) {
                $string .= sprintf('%05b', $char);
            }
        }

        while (\strlen($string) % 8 !== 0) {
            $string = \substr($string, 0, -1);
        }

        return self::chunk($string, 8);
    }

    private static function convertArrayToString(array $binaryArray): string
    {
        $realString = '';

        foreach ($binaryArray as $bin) {
            $pad = \str_pad($bin, 8, 0, STR_PAD_RIGHT);
            $bindec = \bindec($pad);
            $realString .= \chr($bindec);
        }
        return $realString;
    }

    private static function chunk(string $binaryString, int $bits): array
    {
        $binaryString = \chunk_split($binaryString, $bits, ' ');
        $binaryStringLength = \strlen($binaryString);
        $binaryStringSub = \substr($binaryString, $binaryStringLength - 1);

        if ($binaryStringSub === ' ') {
            $binaryString = \substr($binaryString, 0, -1);
        }

        return \explode(' ', $binaryString);
    }
}
