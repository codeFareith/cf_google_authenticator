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
    /**
     * @param array $params
     * @param FrontendLoginController $controller
     * @return string
     */
    public function createOneTimePasswordField(array $params, FrontendLoginController $controller): string
    {
        $extName = \explode('\\', __NAMESPACE__)[1];
        $extKey = GeneralUtility::camelCaseToLowerCaseUnderscored($extName);
        $extConf = \unserialize(
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey],
            [
                'allowed_classes' => false
            ]
        );

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $markerBasedTemplateService = $objectManager->get(MarkerBasedTemplateService::class);
        $languageService = $objectManager->get(LanguageService::class);

        $marker = [];

        if((bool)$extConf['googleAuthenticatorEnableFE'] === true) {

            $marker = [
                '###OTP_LABEL###' => $languageService->sL(
                    \vsprintf(
                        '%s:%s:%s/Resources/Private/Language/%s:%s',
                        [
                            'LLL',
                            'EXT',
                            $extKey,
                            'locallang.xlf',
                            'GoogleAuthenticatorOTP'
                        ]
                    )
                )
            ];

        }

        $content = $markerBasedTemplateService->substituteMarkerArrayCached($params['content'], $marker);

        return $content;
    }
}