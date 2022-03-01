<?php declare(strict_types=1);
/**
 * Class FeLogin
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2022 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Traits\GeneralUtilityObjectManager;
use CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use TYPO3\CMS\Core\Service\MarkerBasedTemplateService;
use TYPO3\CMS\Core\Localization\LanguageService;

/**
 * Hook for the TYPO3 CMS extension 'felogin'
 *
 * This class hooks into the 'felogin' extension to pass additional data
 * in the frontend login template.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 * @since   1.0.0
 */
class FeLogin
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Traits
    \*─────────────────────────────────────────────────────────────────────────────*/
    use GeneralUtilityObjectManager;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var MarkerBasedTemplateService
     */
    private $markerBasedTemplateService;

    /**
     * @var LanguageService
     */
    private $languageService;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function createOneTimePasswordField(array $params): string
    {
        $marker = [];

        if ($this->isGoogleAuthenticatorEnabled()) {
            $localLangLink = PathUtility::makeLocalLangLinkPath('GoogleAuthenticatorOTP');
            $marker = [
                '###OTP_LABEL###' => $this->getLanguageService()->sL($localLangLink),
            ];
        }

        $content = $this->getMarkerBasedTemplateService()->substituteMarkerAndSubpartArrayRecursive($params['content'], $marker);

        return $content;
    }

    private function isGoogleAuthenticatorEnabled(): bool
    {
        $result = false;
        $extConf = ExtensionBasicDataUtility::getExtensionConfiguration();

        if ($extConf['googleAuthenticatorEnableFE'] !== null) {
            $result = (bool) $extConf['googleAuthenticatorEnableFE'];
        }

        return $result;
    }

    private function getMarkerBasedTemplateService(): MarkerBasedTemplateService
    {
        if ($this->markerBasedTemplateService === null) {
            $this->markerBasedTemplateService = $this->objectManager()->get(MarkerBasedTemplateService::class);
        }

        return $this->markerBasedTemplateService;
    }

    private function getLanguageService(): LanguageService
    {
        if ($this->languageService === null) {
            $this->languageService = $this->objectManager()->get(LanguageService::class);
        }

        return $this->languageService;
    }
}
