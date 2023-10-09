<?php declare(strict_types=1);
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

namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Event\DefineIssuerLayerEvent;
use CodeFareith\CfGoogleAuthenticator\Utility\Base32Utility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use Exception;
use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\EventDispatcher\EventDispatcher;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use function sprintf;
use function vsprintf;

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
class UserSettings extends AbstractFormElement
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var AuthenticationSecret
     */
    private $authenticationSecret;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @return string
     * @throws Exception
     */
    public function render(): array
    {
		$result = $this->initializeResultArray();
        $templateView = $this->initializeTemplateView();
        $isEnabled = $this->isGoogleAuthenticatorEnabled();

        $prefix = '';
        if ($this->data['tableName'] !== null) {
            $prefix .= sprintf('[%s]', $this->data['tableName']);
        }
        if ($this->data['databaseRow']['uid'] !== null) {
            $prefix .= sprintf('[%s]', (string)$this->data['databaseRow']['uid']);
        }

        $templateView->assignMultiple(
            [
                'prefix' => $prefix,
                'isEnabled' => $isEnabled,
                'authenticatorSecret' => $this->getAuthenticationSecret(),
            ]
        );

		$result['html'] = $templateView->render();

		return $result;
    }

    private function initializeTemplateView(): StandaloneView
    {
        $templatePath = $this->getTemplatePath();

        /** @var StandaloneView $templateView */
        $templateView = GeneralUtility::makeInstance(StandaloneView::class);
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

        $eventDispatcher = GeneralUtility::makeInstance(EventDispatcher::class);
        $event = new DefineIssuerLayerEvent(
            $this->data['tableName'],
            $layer
        );
        $eventDispatcher->dispatch($event);

        return $event->getLayer();
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
            $this->authenticationSecret = GeneralUtility::makeInstance(
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
}
