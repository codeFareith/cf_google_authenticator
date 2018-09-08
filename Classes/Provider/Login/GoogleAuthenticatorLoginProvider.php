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

namespace CodeFareith\CfGoogleAuthenticator\Provider\Login;

use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use TYPO3\CMS\Backend\Controller\LoginController;
use TYPO3\CMS\Backend\LoginProvider\UsernamePasswordLoginProvider;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Google Authenticator login provider
 *
 * The login provider class overrides the backend login form
 * with a custom template, which comes up with an additional
 * field for the Google Authenticator one-time-password.
 *
 * Class GoogleAuthenticatorLoginProvider
 * @package CodeFareith\CfGoogleAuthenticator\Provider\Login
 */
class GoogleAuthenticatorLoginProvider extends UsernamePasswordLoginProvider
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string */
    public static $loginTemplateFilePath = 'Resources/Private/Templates/Backend/Login.html';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function render(StandaloneView $view, PageRenderer $pageRenderer, LoginController $loginController): void
    {
        parent::render($view, $pageRenderer, $loginController);

        $extensionPath = PathUtility::makeExtensionPath(self::$loginTemplateFilePath);
        $absolutePath = GeneralUtility::getFileAbsFileName($extensionPath);

        $view->setTemplatePathAndFilename($absolutePath);
    }
}
