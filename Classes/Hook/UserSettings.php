<?php
/**
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */
namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Service\GoogleQrImageGenerator;
use CodeFareith\CfGoogleAuthenticator\Utility\Base32Utility;
use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Hook for the user settings
 *
 * This class hooks into the backend user settings,
 * to extend the view by creating a secret key and an image of
 * the QR code for the Google Authenticator.
 *
 * @author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * Class UserSettings
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 */
class UserSettings
{
    /**
     * @param array $data
     * @param UserElement $userElement
     * @return string
     * @throws \Exception
     */
    public function createSecretField(array $data, UserElement $userElement): string
    {
        $layer = '';
        if($data['table'] === 'fe_users') {
            $layer = 'Frontend';
        } else if($data['table'] === 'be_users') {
            $layer = 'Backend';
        }

        $issuer = \vsprintf(
            '%s - %s',
            [
                $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
                $layer
            ]
        );
        $accountName = $data['row']['username'];

        $secretKey = $data['row']['tx_cfgoogleauthenticator_secret'];
        if(empty($secretKey)) {
            $secretKey = Base32Utility::generateRandomString(16);
        }
        $secretImmutable = GeneralUtility::makeInstance(
            AuthenticationSecret::class,
            $issuer,
            $accountName,
            $secretKey
        );

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $imageGenerator = $objectManager->get(GoogleQrImageGenerator::class);

        $templatePath = GeneralUtility::getFileAbsFileName(
            'EXT:cf_google_authenticator/Resources/Private/'
        );

        $templateView = $objectManager->get(StandaloneView::class);
        $templateView->setLayoutRootPaths([$templatePath . 'Layouts/']);
        $templateView->setPartialRootPaths([$templatePath . 'Partials/']);
        $templateView->setTemplateRootPaths([$templatePath . 'Templates/']);

        $templateView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName(
                'EXT:cf_google_authenticator/Resources/Private/Templates/Backend/SecretField.html'
            )
        );

        $chunkedSecret = \chunk_split($secretImmutable->getSecretKey(), 4, '-');
        $chunkedSecretSub = \substr($chunkedSecret, 0, -1);

        $templateView->assignMultiple(
            [
                'table' => $data['table'],
                'uid' => (int)$data['row']['uid'],
                'googleQrImageSrc' => $imageGenerator->generateUri($secretImmutable),
                'googleAuthenticatorEnable' => (bool)$data['row']['tx_cfgoogleauthenticator_enable'],
                'googleAuthenticatorSecret' => $chunkedSecretSub,
            ]
        );

        return $templateView->render();
    }
}