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

namespace CodeFareith\CfGoogleAuthenticator\Service;

use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;

/**
 * QR code image generator
 *
 * This class uses Googles chart API to generate
 * a QR code image. This QR code can then be captured
 * with the phone camera to automatically set up the service
 * in the Google Authenticator app.
 *
 * Class GoogleQrImageGenerator
 * @package CodeFareith\CfGoogleAuthenticator\Service
 */
class GoogleQrCodeGenerator implements QrCodeGeneratorInterface
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    public const CORRECTION_L = 'L'; // recover  7% data loss
    public const CORRECTION_M = 'M'; // recover 15% data loss
    public const CORRECTION_Q = 'Q'; // recover 25% data loss
    public const CORRECTION_H = 'H'; // recover 30% data loss

    protected const BASE_URL = 'https://chart.googleapis.com/';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var int */
    protected $width;

    /** @var int */
    protected $height;

    /** @var string */
    protected $correction;

    /** @var int */
    protected $margin;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(
        int $width = 200,
        int $height = 200,
        string $correction = self::CORRECTION_L,
        int $margin = 4
    )
    {
        $this->width = $width;
        $this->height = $height;
        $this->correction = $correction;
        $this->margin = $margin;
    }

    public function generateUri(AuthenticationSecret $secretImmutable): string
    {
        $data = [
            'chs' => '%sx%s',
            'chld' => '%s|%s',
            'cht' => '%s',
            'chl' => '%s'
        ];
        $query = \http_build_query($data);
        $queryDecoded = \rawurldecode($query);
        $uriEncoded = \rawurlencode($secretImmutable->getUri());

        return vsprintf(
            self::BASE_URL . 'chart?' . $queryDecoded,
            [
                $this->width,
                $this->height,
                $this->correction,
                $this->margin,
                'qr',
                $uriEncoded
            ]
        );
    }
}
