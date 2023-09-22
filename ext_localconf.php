<?php
/**
 * Configuration file for TYPO3 CMS Extension 'cf_google_authenticator'
 *
 * This script is included in the global scope, either frontend or backend.
 * It defines various hooks, registers services and request handlers,
 * etc.
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

defined('TYPO3_MODE')
    or die('Access denied.');

call_user_func(
    static function ($_EXTKEY) {
        $extConf = \CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility::getExtensionConfiguration();

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
            $_EXTKEY,
            'auth',
            \CodeFareith\CfGoogleAuthenticator\Service\AuthenticationService::class,
            [
                'title' => 'Google Authenticator',
                'description' => 'Enable Google 2FA for frontend login',
                'subtype' => 'authUserFE',
                'available' => true,
                'priority' => 80,
                'quality' => 80,
                'os' => '',
                'exec' => '',
                'className' => \CodeFareith\CfGoogleAuthenticator\Service\CoreAuthenticationServiceAdapter::class,
            ]
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
            \CodeFareith\CfGoogleAuthenticator\Utility\TypoScriptUtility::getIncludeTypoScriptFileTag(
                \CodeFareith\CfGoogleAuthenticator\Utility\PathUtility::makeExtensionPath(
                    'Configuration/TypoScript/setup.typoscript'
                )
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            \CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility::getVendorName() . '.' . \CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility::getExtensionKey(),
            'Setup',
            [
                'Frontend\Setup' => 'index,form,update',
            ],
            [
                'Frontend\Setup' => 'form,update',
            ],
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_PLUGIN
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(
            'styles.content.loginform.templateFile = ' . $extConf['feLoginTemplate']
        );

        $GLOBALS['TYPO3_CONF_VARS']
            ['SC_OPTIONS']
                ['t3lib/class.t3lib_tcemain.php']
                    ['processDatamapClass']
                        [$_EXTKEY] = \CodeFareith\CfGoogleAuthenticator\Hook\TCEMain::class;

        $GLOBALS['TYPO3_CONF_VARS']
            ['EXTCONF']
                ['felogin']
                    ['postProcContent']
						[$_EXTKEY] = \CodeFareith\CfGoogleAuthenticator\Hook\FeLogin::class . '->createOneTimePasswordField';

		// Register a node in ext_localconf.php
		$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1606376982] = [
			'nodeName' => 'TwoFactorAuth',
			'priority' => 40,
			'class' => \CodeFareith\CfGoogleAuthenticator\Hook\UserSettings::class,
		];

        // Migrate TOTP setup from EXT:cf_google_authenticator to native MFA
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\CodeFareith\CfGoogleAuthenticator\Updates\MFAUpdateWizard::class]
            = \CodeFareith\CfGoogleAuthenticator\Updates\MFAUpdateWizard::class;
    },
    /** @var string $_EXTKEY */
    'cf_google_authenticator'
);
