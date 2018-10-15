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

namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Service\GoogleQrCodeGenerator;
use CodeFareith\CfGoogleAuthenticator\Service\QrCodeGeneratorInterface;
use CodeFareith\CfGoogleAuthenticator\Traits\GeneralUtilityObjectManager;
use CodeFareith\CfGoogleAuthenticator\Utility\Base32Utility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Hook for the user settings
 *
 * This class hooks into the backend user settings,
 * to extend the view by creating a secret key and an image of
 * the QR code for the Google Authenticator.
 *
 * Class UserSettings
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 */
class UserSettings
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Traits
    \*─────────────────────────────────────────────────────────────────────────────*/
    use GeneralUtilityObjectManager;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var mixed[] */
    protected $data;

    /** @var AuthenticationSecret */
    private $authenticationSecret;

    /** @var QrCodeGeneratorInterface */
    private $qrCodeGenerator;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @param mixed[] $data
     * @return string
     * @throws \Exception
     */
    public function createSecretField(array $data): string
    {
        $this->data = $data;

        $authenticationSecret = $this->getAuthenticationSecret();
        $templateView = $this->initializeTemplateView();
        $isEnabled = $this->isGoogleAuthenticatorEnabled();
        $qrCodeUri = $this->getQrCodeGenerator()->generateUri($authenticationSecret);

        $templateView->assignMultiple(
            [
                'table' => $data['table'],
                'uid' => (int)$data['row']['uid'],
                'isEnabled' => $isEnabled,
                'qrCodeUri' => $qrCodeUri,
                'authenticatorSecret' => $this->getAuthenticationSecret()->getSecretKey(),
            ]
        );

        return $templateView->render();
    }

    private function initializeTemplateView(): StandaloneView
    {
        $templatePath = $this->getTemplatePath();

        $templateView = $this->getObjectManager()->get(StandaloneView::class);
        $templateView->setLayoutRootPaths([$templatePath . 'Layouts/']);
        $templateView->setPartialRootPaths([$templatePath . 'Partials/']);
        $templateView->setTemplateRootPaths([$templatePath . 'Templates/']);

        $templateView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName(
                PathUtility::makeExtensionPath('Resources/Private/Templates/Backend/UserSettings.html')
            )
        );

        return $templateView;
    }

    private function getTemplatePath(): string
    {
        return GeneralUtility::getFileAbsFileName(
            PathUtility::makeExtensionPath('Resources/Private/')
        );
    }

    private function getIssuer(): string
    {
        return \vsprintf(
            '%s - %s',
            [
                $this->getSiteName(),
                $this->getLayer()
            ]
        );
    }

    private function getSiteName(): string
    {
        return $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
    }

    private function getLayer(): string
    {
        $layer = '';

        if ($this->data['table'] === 'fe_user') {
            $layer = 'Frontend';
        } else if ($this->data['table'] === 'be_user') {
            $layer = 'Backend';
        }

        return $layer;
    }

    private function getUsername(): string
    {
        return $this->data['row']['username'];
    }

    /**
     * @throws \Exception
     */
    private function getAuthenticationSecret(): AuthenticationSecret
    {
        if ($this->authenticationSecret === null) {
            /** @noinspection PhpMethodParametersCountMismatchInspection */
            $this->authenticationSecret = $this->getObjectManager()->get(
                AuthenticationSecret::class,
                $this->getIssuer(),
                $this->getUsername(),
                $this->getSecretKey()
            );
        }

        return $this->authenticationSecret;
    }

    /**
     * @throws \Exception
     */
    private function getSecretKey(): string
    {
        if ($this->isGoogleAuthenticatorEnabled()) {
            $secretKey = $this->data['row']['tx_cfgoogleauthenticator_secret'];
        } else {
            $secretKey = Base32Utility::generateRandomString(16);
        }

        return $secretKey;
    }

    private function isGoogleAuthenticatorEnabled(): bool
    {
        return (bool)$this->data['row']['tx_cfgoogleauthenticator_enabled'];
    }

    private function getQrCodeGenerator(): QrCodeGeneratorInterface
    {
        if ($this->qrCodeGenerator === null) {
            $this->qrCodeGenerator = $this->getObjectManager()->get(GoogleQrCodeGenerator::class);
        }

        return $this->qrCodeGenerator;
    }
}
