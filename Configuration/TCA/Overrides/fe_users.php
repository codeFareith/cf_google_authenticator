<?php
/**
 * Table configuration for 'fe_users'
 *
 * This script determines how the new database table columns of the fe_users table
 * are represented and handled in the TYPO3 backend.
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2019 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

defined('TYPO3_MODE')
    or die('Access denied');

call_user_func(
    static function () {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
            'fe_users',
            [
                'tx_cfgoogleauthenticator_enabled' => [
                    'exclude' => false,
                    'label' => \CodeFareith\CfGoogleAuthenticator\Utility\PathUtility::makeLocalLangLinkPath(
                        'fe_users.tx_cfgoogleauthenticator_enabled',
                        'locallang_db.xlf'
                    ),
                    'config' => [
                        'type' => 'check',
                    ],
                ],
                'tx_cfgoogleauthenticator_secret' => [
                    'exclude' => false,
                    'label' => \CodeFareith\CfGoogleAuthenticator\Utility\PathUtility::makeLocalLangLinkPath(
                        'be_users.tx_cfgoogleauthenticator_secret',
                        'locallang_db.xlf'
                    ),
                    'config' => [
                        'type' => 'user',
                        'renderType' => 'TwoFactorAuth',
                    ],
                ],
            ]
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'fe_users',
            '--div--;'
            . \CodeFareith\CfGoogleAuthenticator\Utility\PathUtility::makeLocalLangLinkPath(
                'tx_cfgoogleauthenticator',
                'locallang_db.xlf'
            ) . ',
            tx_cfgoogleauthenticator_enabled,
            tx_cfgoogleauthenticator_secret'
        );
    }
);
