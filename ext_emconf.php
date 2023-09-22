<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "cf_google_authenticator".
 *
 * Auto generated 23-11-2020 17:42
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => '[codeFareith] Google Authenticator',
    'description' => 'Enable Google 2FA (two factor authentication) for both, frontend- and backend accounts.',
    'category' => 'misc',
    'author' => 'Robin "codeFareith" von den Bergen',
    'author_email' => 'robin@vondenbergen.de',
    'author_company' => '',
    'state' => 'stable',
    'version' => '1.3.0-dev',
    'uploadFolders' => false,
    'clearCacheOnLoad' => true,
    'constraints' => [
        'depends' => [
            'php' => '7.4.0-8.2.99',
            'typo3' => '11.5.0-12.4.99',
            'felogin' => '11.5.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'CodeFareith\\CfGoogleAuthenticator\\' => 'Classes',
        ],
    ],
    'autoload-dev' => [
        'psr-4' => [
            'CodeFareith\\CfGoogleAuthenticator\\Tests\\' => 'Tests',
        ],
    ],
    'uploadfolder' => false,
    'clearcacheonload' => true,
];

