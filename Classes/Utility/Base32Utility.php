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
class Base32Utility
{
    public const RFC4648 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=';
    public const CROCKFORD = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    public const MIME_09AV = '0123456789ABCDEFGHIJKLMNOPQRSTUV';

    /**
     * @param string $string
     * @param string $charset
     * @return string
     */
    public static function encode(string $string, string $charset = self::RFC4648): string
    {
        if($string === '') {
            return '';
        }

        $binaryString = '';

        foreach(\str_split($string) as $s) {
            $ord = \ord($s);
            $binaryString .= \sprintf('%08b', $ord);
        }

        $binaryArray = self::chunk($binaryString, 5);
        $binaryArrayLength = \count($binaryArray);

        while($binaryArrayLength % 8 !== 0) {
            $binaryArray[] = null;
        }

        $base32String = '';

        foreach($binaryArray as $bin) {
            $char = 32;

            if($bin !== null) {
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

    /**
     * @param $base32String
     * @param string $charset
     * @return string
     */
    public static function decode($base32String, string $charset = self::RFC4648): string
    {
        $base32String = \strtoupper($base32String);

        $pattern = '/[^A-Z2-7]/';
        $base32String = \preg_replace($pattern, '', $base32String);

        if($base32String === '') {
            return '';
        }

        $base32Array = \str_split($base32String);
        $string = '';

        foreach($base32Array as $str) {
            $char = \strpos($charset, $str);

            if($char !== 32) {
                $string .= sprintf('%05b', $char);
            }
        }

        while (\strlen($string) %8 !== 0) {
            $string = \substr($string, 0, -1);
        }

        $binaryArray = self::chunk($string, 8);
        $realString = '';

        foreach($binaryArray as $bin) {
            $pad = \str_pad($bin, 8, 0, STR_PAD_RIGHT);
            $bindec = \bindec($pad);
            $realString .= \chr($bindec);
        }

        return $realString;
    }

    /**
     * @param int $length
     * @param string $charset
     * @return string
     * @throws \Exception
     */
    public static function generateRandomString(int $length, string $charset = self::RFC4648): string
    {
        $key = '';

        while(\strlen($key) < $length) {
            $rand = \random_int(0, 31);
            $key .= $charset[$rand];
        }

        return $key;
    }

    /**
     * @param $binaryString
     * @param $bits
     * @return array
     */
    private static function chunk($binaryString, $bits): array
    {
        $binaryString = \chunk_split($binaryString, $bits, ' ');
        $binaryStringLength = \strlen($binaryString);
        $binaryStringSub = \substr($binaryString, $binaryStringLength - 1);

        if ($binaryStringSub  === ' ') {
            $binaryString = \substr($binaryString, 0, -1);
        }

        return \explode(' ', $binaryString);
    }
}