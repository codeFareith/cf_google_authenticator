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
 * @author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */

use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;

/** @var $_EXTKEY string */

defined('TYPO3_MODE')
    or die('Access denied.');

\call_user_func(
    function($_EXTKEY)
    {
        $globalsReference = &$GLOBALS;

        $globalsReference['TBE_STYLES']
            ['stylesheet2'] = PathUtility::makeExtensionPath('Resources/Public/Css/cf_google_authenticator.css');
    },
    $_EXTKEY
);
