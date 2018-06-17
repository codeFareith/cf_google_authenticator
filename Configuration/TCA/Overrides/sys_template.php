<?php
/**
 * Table configuration for 'sys_template'
 *
 * This script determines how the new database table columns of the sys_template table
 * are represented and handled in the TYPO3 backend.
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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE')
    or die('Access denied');

$lll = \vsprintf(
    '%s:%s:%s/Resources/Private/Language/%s',
    [
        'LLL',
        'EXT',
        'cf_google_authenticator',
        'locallang_db.xlf'
    ]
);

ExtensionManagementUtility::addFieldsToUserSettings(
    '--div--;' . $lll . ':tx_cfgoogleauthenticator,
    tx_cfgoogleauthenticator_enable,
    tx_cfgoogleauthenticator_secret'
);