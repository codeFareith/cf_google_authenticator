<?php
/**
 * Configuration file for TYPO3 CMS Extension 'cf_google_authenticator'
 *
 * This script is only included when a TYPO3 Backend or CLI request is
 * happening or the TYPO3 Frontend is called and a valid Backend User is
 * authenticated.
 * It is used for registering backend modules, adding context-sensitive-help
 * docs, adding table-options, making assignments to the global configuration
 * arrays $TBE_STYLES and $PAGES_TYPES, etc.
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

use CodeFareith\CfGoogleAuthenticator\Hook\UserSettings;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;

defined('TYPO3_MODE')
    or die('Access denied.');

call_user_func(
    static function (/*$_EXTKEY*/) {
        $globalsReference = &$GLOBALS;

        $globalsReference['TBE_STYLES']
            ['stylesheet2'] = PathUtility::makeExtensionPath('Resources/Public/Css/cf_google_authenticator.css');

        if (TYPO3_version >= '9.0.0') {
            $globalsReference['TYPO3_USER_SETTINGS']['columns'] = array_merge(
                $globalsReference['TYPO3_USER_SETTINGS']['columns'],
                [
                    'tx_cfgoogleauthenticator_enabled' => [
                        'label' => PathUtility::makeLocalLangLinkPath(
                            'be_users.tx_cfgoogleauthenticator_enabled',
                            'locallang_db.xlf'
                        ),
                        'type' => 'check',
                        'table' => 'be_users',
                    ],

                    'tx_cfgoogleauthenticator_secret' => [
                        'label' => PathUtility::makeLocalLangLinkPath(
                            'be_users.tx_cfgoogleauthenticator_secret',
                            'locallang_db.xlf'
                        ),
                        'type' => 'user',
                        'userFunc' => UserSettings::class . '->createSecretField',
                        'table' => 'be_users',
                    ],
                ]
            );
        }
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings(
            '--div--;'
            . PathUtility::makeLocalLangLinkPath(
                'tx_cfgoogleauthenticator',
                'locallang_db.xlf'
            ) . ',
                tx_cfgoogleauthenticator_enabled,
                tx_cfgoogleauthenticator_secret'
        );
    },
    /** @var string $_EXTKEY */
    $_EXTKEY
);
