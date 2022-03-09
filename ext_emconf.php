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
    'version' => '1.2.4',
    'uploadFolders' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,
    'constraints' => [
        'depends' => [
            'php' => '7.2-',
            'typo3' => '9.5.0-10.4.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
            'felogin' => '9.5.0-10.4.99',
        ],
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
];

