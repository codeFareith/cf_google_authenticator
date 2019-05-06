<?php
/**
 * Declaration file for TYPO3 CMS Extension 'cf_google_authenticator'
 *
 * This file contains a declaration of what this extension is and does for the
 * Extension Manager.
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

/** @var string $_EXTKEY */

$EM_CONF[$_EXTKEY] = [
    'title' => '[codeFareith] Google Authenticator',
    'description' => 'Enable Google 2FA (two factor authentication) for both, frontend- and backend accounts.',
    'category' => 'misc',

    'author' => 'Robin "codeFareith" von den Bergen',
    'author_email' => 'rvdb@fareith.de',
    'author_company' => '',

    'state' => 'stable',
    'version' => '1.1.3',

    'uploadFolders' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,

    'constraints' => [
        'depends' => [
            'php' => '7.1-',
            'typo3' => '7.6.0-9.9.99',
            'felogin' => '7.6.0-9.9.99'
        ],
        'conflicts' => [

        ],
        'suggests' => [

        ]
    ],

    'autoload' => [
        'psr-4' => [
            'CodeFareith\\CfGoogleAuthenticator\\' => 'Classes'
        ]
    ]
];
