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

$EM_CONF[$_EXTKEY] = array (
  'title' => '[codeFareith] Google Authenticator',
  'description' => 'Enable Google 2FA (two factor authentication) for both, frontend- and backend accounts.',
  'category' => 'misc',
  'author' => 'Robin "codeFareith" von den Bergen',
  'author_email' => 'robin@vondenbergen.de',
  'author_company' => '',
  'state' => 'stable',
  'version' => '1.2.4',
  'uploadFolders' => false,
  'clearCacheOnLoad' => true,
  'constraints' =>
  array (
    'depends' =>
    array (
      'php' => '7.1-',
      'typo3' => '10.4.99-',
    ),
    'conflicts' =>
    array (
    ),
    'suggests' =>
    array (
      'felogin' => '10.4.99-',
    ),
  ),
  'autoload' =>
  array (
    'psr-4' =>
    array (
      'CodeFareith\\CfGoogleAuthenticator\\' => 'Classes',
    ),
  ),
  'autoload-dev' =>
  array (
    'psr-4' =>
    array (
      'CodeFareith\\CfGoogleAuthenticator\\Tests\\' => 'Tests',
    ),
  ),
  'uploadfolder' => false,
  'clearcacheonload' => true,
);

