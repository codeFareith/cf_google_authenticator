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

use CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use TYPO3\CMS\Core\Service\MarkerBasedTemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Felogin\Controller\FrontendLoginController;
use TYPO3\CMS\Lang\LanguageService;

/**
 * Hook for the TYPO3 CMS extension 'felogin'
 *
 * This class hooks into the 'felogin' extension to pass additional data
 * in the frontend login template.
 *
 * Class FeLogin
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 */
class FeLogin
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var ObjectManager */
    private $objectManager;

    /** @var MarkerBasedTemplateService */
    private $markerBasedTemplateService;

    /** @var LanguageService */
    private $languageService;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function createOneTimePasswordField(array $params, FrontendLoginController $controller): string
    {
        $marker = [];

        if ($this->isGoogleAuthenticatorEnabled()) {
            $localLangLink = PathUtility::makeLocalLangLinkPath('GoogleAuthenticatorOTP');
            $marker = [
                '###OTP_LABEL###' => $this->getLanguageService()->sL($localLangLink)
            ];
        }

        $content = $this->getMarkerBasedTemplateService()->substituteMarkerArrayCached($params['content'], $marker);

        return $content;
    }

    private function isGoogleAuthenticatorEnabled(): bool
    {
        $result = false;
        $extConf = ExtensionBasicDataUtility::getExtensionConfiguration();

        if ($extConf['googleAuthenticatorEnableFE'] !== null) {
            $result = (bool)$extConf['googleAuthenticatorEnableFE'];
        }

        return $result;
    }

    private function getObjectManager(): ObjectManager
    {
        if ($this->objectManager === null) {
            $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        }

        return $this->objectManager;
    }

    private function getMarkerBasedTemplateService(): MarkerBasedTemplateService
    {
        if ($this->markerBasedTemplateService === null) {
            $this->markerBasedTemplateService = $this->getObjectManager()->get(MarkerBasedTemplateService::class);
        }

        return $this->markerBasedTemplateService;
    }

    private function getLanguageService(): LanguageService
    {
        if ($this->languageService === null) {
            $this->languageService = $this->getObjectManager()->get(LanguageService::class);
        }

        return $this->languageService;
    }
}
