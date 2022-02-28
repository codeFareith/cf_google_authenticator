<?php

declare(strict_types=1);

/**
 * Class UserSettings
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

namespace CodeFareith\CfGoogleAuthenticator\Backend\Form\Element;

use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Service\GoogleQrCodeGenerator;
use CodeFareith\CfGoogleAuthenticator\Service\QrCodeGeneratorInterface;
use CodeFareith\CfGoogleAuthenticator\Traits\GeneralUtilityObjectManager;
use CodeFareith\CfGoogleAuthenticator\Utility\Base32Utility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;
use TYPO3\CMS\Fluid\View\StandaloneView;
use function sprintf;
use function vsprintf;
use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;

/**
 * Hook for the user settings
 *
 * This class hooks into the backend user settings,
 * to extend the view by creating a secret key and an image of
 * the QR code for the Google Authenticator.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 * @since   1.0.0
 */
class TwoFactorAuth extends AbstractFormElement
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Traits
    \*─────────────────────────────────────────────────────────────────────────────*/
    use GeneralUtilityObjectManager;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var mixed[]
     */
    protected $data;

    /**
     * @var AuthenticationSecret
     */
    private $authenticationSecret;

    /**
     * @var QrCodeGeneratorInterface
     */
    private $qrCodeGenerator;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @return array
     * @throws Exception
     */
    public function render(): array
    {
        $result = $this->initializeResultArray();
        $authenticationSecret = $this->getAuthenticationSecret();
        $templateView = $this->initializeTemplateView();
        $isEnabled = $this->isGoogleAuthenticatorEnabled();
        $qrCodeUri = $this->getQrCodeGenerator()->generateUri($authenticationSecret);

        $prefix = '';
        if ($this->data['tableName'] !== null) {
            $prefix .= sprintf('[%s]', $this->data['tableName']);
        }
        if ($data['databaseRow']['uid'] !== null) {
            $prefix .= sprintf('[%s]', (string)$this->data['databaseRow']['uid']);
        }

        $templateView->assignMultiple(
            [
                'prefix' => $prefix,
                'isEnabled' => $isEnabled,
                'qrCodeUri' => $qrCodeUri,
                'authenticatorSecret' => $this->getAuthenticationSecret()->getSecretKey(),
            ]
        );

        $result['html'] = $templateView->render();

        return $result;
    }

    private function initializeTemplateView(): StandaloneView
    {
        $templatePath = $this->getTemplatePath();

        /** @var StandaloneView $templateView */
        $templateView = $this->objectManager()->get(StandaloneView::class);
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
        return vsprintf(
            '%s - %s',
            [
                $this->getSiteName(),
                $this->getLayer(),
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

        if ($this->data['tableName'] === 'fe_users') {
            $layer = 'Frontend';
        } elseif ($this->data['tableName'] === 'be_users') {
            $layer = 'Backend';
        }

        $dispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $signalArguments = [
            'table' => $this->data['tableName'],
            'layer' => $layer,
            'caller' => $this,
        ];
        $signalArguments = $dispatcher->dispatch(
            __CLASS__,
            'defineIssuerLayer',
            $signalArguments
        );

        return $signalArguments['layer'];
    }

    private function getUsername(): string
    {
        return $this->data['databaseRow']['username'] ?? '';
    }

    /**
     * @throws Exception
     */
    private function getAuthenticationSecret(): AuthenticationSecret
    {
        if ($this->authenticationSecret === null) {
            $this->authenticationSecret = $this->objectManager()->get(
                AuthenticationSecret::class,
                $this->getIssuer(),
                $this->getUsername(),
                $this->getSecretKey()
            );
        }

        return $this->authenticationSecret;
    }

    /**
     * @throws Exception
     */
    private function getSecretKey(): string
    {
        if ($this->isGoogleAuthenticatorEnabled()) {
            $secretKey = (string) $this->data['databaseRow']['tx_cfgoogleauthenticator_secret'];
        } else {
            $secretKey = Base32Utility::generateRandomString(16);
        }

        return $secretKey;
    }

    private function isGoogleAuthenticatorEnabled(): bool
    {
        if ($this->data['parameterArray']['fieldConf']['config']['type'] === 'user' && !is_array($this->data['databaseRow'])) {
            $this->data['databaseRow'] = $GLOBALS['BE_USER']->user;
        }
        return (bool) $this->data['databaseRow']['tx_cfgoogleauthenticator_enabled'];
    }

    private function getQrCodeGenerator(): QrCodeGeneratorInterface
    {
        if ($this->qrCodeGenerator === null) {
            $this->qrCodeGenerator = $this->objectManager()->get(GoogleQrCodeGenerator::class);
        }

        return $this->qrCodeGenerator;
    }
}
