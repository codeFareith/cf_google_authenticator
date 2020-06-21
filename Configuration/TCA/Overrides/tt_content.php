<?php
/**
 * Table configuration for 'tt_content'
 *
 * This script extends the tt_content
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
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            \CodeFareith\CfGoogleAuthenticator\Utility\ExtensionBasicDataUtility::getExtensionKey(),
            'Setup',
            \CodeFareith\CfGoogleAuthenticator\Utility\PathUtility::makeLocalLangLinkPath('plugin.setup')
        );
    }
);
