<?php declare(strict_types=1);
/**
 * Table configuration for 'be_users'
 *
 * This script determines how the new database table columns of the be_users table
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

use CodeFareith\CfGoogleAuthenticator\Hook\UserSettings;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE')
    or die('Access denied');

call_user_func(
    static function () {
        ExtensionManagementUtility::addTCAcolumns(
            'be_users',
            [
                'tx_cfgoogleauthenticator_enabled' => [
                    'exclude' => false,
                    'label' => PathUtility::makeLocalLangLinkPath(
                        'be_users.tx_cfgoogleauthenticator_enabled',
                        'locallang_db.xlf'
                    ),
                    'config' => [
                        'type' => 'check',
                    ],
                ],
                'tx_cfgoogleauthenticator_secret' => [
                    'exclude' => false,
                    'label' => PathUtility::makeLocalLangLinkPath(
                        'be_users.tx_cfgoogleauthenticator_secret',
                        'locallang_db.xlf'
                    ),
                    'config' => [
                        'type' => 'user',
                        'userFunc' => UserSettings::class . '->createSecretField',
                    ],
                ],
            ]
        );

        ExtensionManagementUtility::addToAllTCAtypes(
            'be_users',
            '--div--;'
            . PathUtility::makeLocalLangLinkPath(
                'tx_cfgoogleauthenticator',
                'locallang_db.xlf'
            ) . ',
            tx_cfgoogleauthenticator_enabled,
            tx_cfgoogleauthenticator_secret'
        );
    }
);
