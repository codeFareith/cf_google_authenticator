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
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE')
    or die('Access denied.');

\call_user_func(
    function($_EXTKEY)
    {
        // get extension configuration
        $extConf = \unserialize(
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY],
            [
                'allowed_classes' => false
            ]
        );

        // register GoogleAuthenticatorService
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

        // register GoogleAuthenticatorLoginProvider
        if((bool)$extConf['googleAuthenticatorEnableBE'] === true) {
            $GLOBALS['TYPO3_CONF_VARS']
                ['EXTCONF']
                    ['backend']
                        ['loginProviders']
                            [1433416747]
                                ['provider'] = GoogleAuthenticatorLoginProvider::class;
        }

        // register hook for TCEMain
        $GLOBALS['TYPO3_CONF_VARS']
            ['SC_OPTIONS']
                ['t3lib/class.t3lib_tcemain.php']
                    ['processDatamapClass']
                        [$_EXTKEY] = TCEMain::class;

        // register hook for FeLogin
        $GLOBALS['TYPO3_CONF_VARS']
            ['EXTCONF']
                ['felogin']
                    ['postProcContent']
                        [$_EXTKEY] = FeLogin::class . '->createOneTimePasswordField';
    },
    $_EXTKEY
);