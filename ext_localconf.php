<?php
/**
 * Configuration file for TYPO3 CMS Extension 'cf_google_authenticator'
 *
 * This script is included in the global scope, either frontend or backend.
 * It defines various hooks, registers services and request handlers,
 * etc.
 *
 * @author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */

/** @var $_EXTKEY string */

use CodeFareith\CfGoogleAuthenticator\Hook\FeLogin;
use CodeFareith\CfGoogleAuthenticator\Hook\TCEMain;
use CodeFareith\CfGoogleAuthenticator\Provider\Login\GoogleAuthenticatorLoginProvider;
use CodeFareith\CfGoogleAuthenticator\Service\GoogleAuthenticatorService;
use CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use CodeFareith\CfGoogleAuthenticator\Utility\TypoScriptUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3_MODE')
    or die('Access denied.');

\call_user_func(
    function($_EXTKEY)
    {
        $globalsReference = &$GLOBALS;

        $extConf = ExtensionBasicDataUtility::getExtensionConfiguration();

        ExtensionManagementUtility::addService(
            $_EXTKEY,
            'auth',
            GoogleAuthenticatorService::class,
            [
                'title' => 'Google Authenticator',
                'description' => 'Enable Google 2FA for both, frontend- and backend login',
                'subtype' => 'authUserFE,authUserBE',
                'available' => true,
                'priority' => 80,
                'quality' => 80,
                'os' => '',
                'exec' => '',
                'className' => GoogleAuthenticatorService::class
            ]
        );

        ExtensionManagementUtility::addUserTSConfig(
            TypoScriptUtility::getIncludeTypoScriptFileTag(
                PathUtility::makeExtensionPath(
                    'Configuration/TypoScript/setup.typoscript'
                )
            )
        );

        ExtensionUtility::configurePlugin(
            ExtensionBasicDataUtility::getVendorName() . '.' . ExtensionBasicDataUtility::getExtensionKey(),
            'Setup',
            [
                'Frontend\Setup' => 'index,form,update'
            ],
            [
                'Frontend\Setup' => 'form,update'
            ],
            ExtensionUtility::PLUGIN_TYPE_PLUGIN
        );

        if((bool)$extConf['googleAuthenticatorEnableFE'] === true) {
            ExtensionManagementUtility::addTypoScriptConstants(
                'styles.content.loginform.templateFile = ' . $extConf['feLoginTemplate']
            );
        }

        if((bool)$extConf['googleAuthenticatorEnableBE'] === true) {
            $globalsReference['TYPO3_CONF_VARS']
                ['EXTCONF']
                    ['backend']
                        ['loginProviders']
                            [1433416747]
                                ['provider'] = GoogleAuthenticatorLoginProvider::class;
        }

        $globalsReference['TYPO3_CONF_VARS']
            ['SC_OPTIONS']
                ['t3lib/class.t3lib_tcemain.php']
                    ['processDatamapClass']
                        [$_EXTKEY] = TCEMain::class;

        $globalsReference['TYPO3_CONF_VARS']
            ['EXTCONF']
                ['felogin']
                    ['postProcContent']
                        [$_EXTKEY] = FeLogin::class . '->createOneTimePasswordField';
    },
    $_EXTKEY
);
