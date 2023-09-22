<?php
declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace CodeFareith\CfGoogleAuthenticator\ViewHelpers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Service\GoogleQrCodeGenerator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class QrImageViewHelper extends AbstractTagBasedViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    protected $tagName = 'img';

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
        $this->registerArgument('secret', AuthenticationSecret::class, 'OTP secret.');
        $this->registerArgument('alt', 'string', 'Specifies an alternate text for the image.', false, 'QR code');
        $this->registerArgument('size', 'int', 'width/height of the QR code.', false, 200);
        $this->registerArgument('correction', 'string', 'Either "L" to recover 7% of data loss, "M" (15%), "Q" (25%) or "H" (30%).', false, "L");
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     */
    public function render()
    {
        /** @var AuthenticationSecret $authenticationSecret */
        $authenticationSecret = $this->arguments['secret'];
        $alt = $this->arguments['alt'];
        $size = (int)$this->arguments['size'];
        $correction = $this->arguments['correction'];

        if ($authenticationSecret === null) {
            throw new Exception('You must specify an AuthenticationSecret object.', 1695388359);
        }

        if (class_exists(QRCode::class)) {
            $options = new QROptions();
            $options->level = 7;
            switch ($correction) {
                case 'H':
                    $options->eccLevel = QRCode::ECC_H;
                    break;
                case 'Q':
                    $options->eccLevel = QRCode::ECC_Q;
                    break;
                case 'M':
                    $options->eccLevel = QRCode::ECC_M;
                    break;
                case 'L':
                default:
                    $options->eccLevel = QRCode::ECC_L;
                    break;
            }
            $imageUri = (new QRCode($options))->render($authenticationSecret->getUri());
        } else {
            // Fallback, needed when not using Composer since 3rd-party library is
            // (at least currently) not distributed with the .t3x available off TER.
            if (!in_array($correction, ['L', 'M', 'Q', 'H'], true)) {
                $correction = 'L';
            }
            $qrCodeGenerator = GeneralUtility::makeInstance(
                GoogleQrCodeGenerator::class,
                $size,
                $size,
                $correction
            );
            $imageUri = $qrCodeGenerator->generateUri($authenticationSecret);
        }

        $this->tag->addAttribute('src', $imageUri);
        $this->tag->addAttribute('width', $size);
        $this->tag->addAttribute('alt', $alt);

        return $this->tag->render();
    }
}
