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
        $globalsReference = &$GLOBALS;

        $extConf = \CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility::getExtensionConfiguration();

        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Extbase\Object\ObjectManager::class
        );
        $adapterFactory = $objectManager->get(\CodeFareith\CfGoogleAuthenticator\Service\GoogleAuthenticationServiceAdapterFactory::class);
        $adapter = $adapterFactory->create();

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
            $_EXTKEY,
            'auth',
            \CodeFareith\CfGoogleAuthenticator\Service\AuthenticationService::class,
            [
                'title' => 'Google Authenticator',
                'description' => 'Enable Google 2FA for both, frontend- and backend login',
                'subtype' => 'authUserFE,authUserBE',
                'available' => true,
                'priority' => 80,
                'quality' => 80,
                'os' => '',
                'exec' => '',
                'className' => get_class($adapter),
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

        if ((bool) $extConf['googleAuthenticatorEnableFE'] === true) {
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(
                'styles.content.loginform.templateFile = ' . $extConf['feLoginTemplate']
            );
        }

        if ((bool) $extConf['googleAuthenticatorEnableBE'] === true) {
            $globalsReference['TYPO3_CONF_VARS']
                ['EXTCONF']
                    ['backend']
                        ['loginProviders']
                            [1433416747]
                                ['provider'] = \CodeFareith\CfGoogleAuthenticator\Provider\Login\GoogleAuthenticatorLoginProvider::class;
        }

        $globalsReference['TYPO3_CONF_VARS']
            ['SC_OPTIONS']
                ['t3lib/class.t3lib_tcemain.php']
                    ['processDatamapClass']
                        [$_EXTKEY] = \CodeFareith\CfGoogleAuthenticator\Hook\TCEMain::class;

        $globalsReference['TYPO3_CONF_VARS']
            ['EXTCONF']
                ['felogin']
                    ['postProcContent']
                        [$_EXTKEY] = \CodeFareith\CfGoogleAuthenticator\Hook\FeLogin::class . '->createOneTimePasswordField';
    },
    /** @var string $_EXTKEY */
    $_EXTKEY
);
