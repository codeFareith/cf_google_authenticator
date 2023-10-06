# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
- nothing, yet

## [1.3.0] - *not yet released*
### Changed
- compatibility with TYPO3 v11 and v12
- QR code are generated natively if extension is installed with composer, otherwise it will fall back (as before) to
  the online service on chart.googleapis.com
- default templates are using UIkit templating framework (as before) but a constant in TypoScript lets you
  switch to Bootstrap 5

## [1.2.4] - 2020-07-23
### Changed
- update `composer.lock`

## [1.2.3] - 2020-07-23
### Fixed
- use `$GLOBALS['BE_USER']` instead of `TYPO3\CMS\Core\Authentication\BackendUserAuthentication` in `..\Classes\Hook\UserSettings` to detect authenticator enabled state

## [1.2.2] - 2020-07-06
### Fixed
- use `TYPO3\CMS\Core\Authentication\BackendUserAuthentication` in `..\Classes\Hook\UserSettings` to detect authenticator enabled state

### Changed
- Complete `de.locallang.xlf`

## [1.2.1] - 2020-06-12
### Fixed
- Various bugs caused by `use`- and `declare(strict_type=1);`-Statements in extension's bootstrap files (`ext_localconf.php`, `ext_tables.php`, `be_users.php`, `fe_users.php`, `sys_template.php` & `tt_content.php`)

## [1.2.0] - 2020-06-12
### Changed
- Add Signal/Slot-Dispatcher in Google Authenticator Setup Handler
- Add Context to SetupController

## [1.1.7] - 2019-09-06
### Changed
- Add `declare(strict_type=1);` to all PHP files
- Add fluid namespace to templates
- bump symfony/yaml from 4.3.3 to 4.3.4
- bump symfony/event-dispatcher from 4.3.3 to 4.3.4
- bump symfony/dom-crawler from 4.3.3 to 4.3.4
- bump typo3/cms-reports from 8.7.26 to 8.7.27
- bump symfony/css-selector from 4.3.3 to 4.3.4
- bump typo3/cms-setup from 8.7.26 to 8.7.27
- bump symfony/process from 4.3.3 to 4.3.4
- bump symfony/browser-kit from 4.3.3 to 4.3.4
- bump symfony/finder from 4.3.3 to 4.3.4


## [1.1.6] - 2019-09-06
### Changed
- bump codeception/phpunit-wrapper from 6.6.1 to 6.7.0
- bump codeception/codeception from 3.0.3 to 3.1.0
- bump typo3/cms-core from 8.7.25 to 8.7.27
- bump doctrine/lexer from 1.0.1 to 1.1.0
- bump mikey179/vfsstream from 1.6.6 to 1.6.7
- bump theseer/tokenizer from 1.1.2 to 1.1.3
- bump doctrine/annotations from 1.6.1 to 1.7.0
- bump doctrine/collections from 1.6.1 to 1.6.2
- bump webmozart/assert from 1.4.0 to 1.5.0
- bump symfony/console from 4.3.3 to 4.3.4

## [1.1.5] - 2019-05-11
### Added
- Interface `..\Classes\Service\AuthenticationService`
- Interface `..\Classes\Service\AuthenticationServiceAdapterFactory`
- Class `..\Classes\Service\CoreAuthenticationServiceAdapter`
- Class `..\Classes\Service\GoogleAuthenticationServiceAdapterFactory`
- Class `..\Classes\Service\LegacyAuthenticationServiceAdapter`
- File `composer.lock`
- File `.scrutinizer.yml`

### Changed
- Set `minimum_stability` in `composer.json` to `dev`
- Define safelisted branches for Travis-CI
- Eliminate deprecated function usage
- Make anonymous function calls static
- Update issue templates
- Update versions and script descriptions in `composer.json`
- Add `.git` to `.gitignore`
- Update phpunit/php-code-coverage requirement
- Update README.md
- Update composer.json
- Clean up code of SetupController & Mapper
- Update CI files

### Fixed
- Remove "use" statement for core classes in ext_* files
- Avoid TypeError when record info is null

## [1.1.4] - 2019-05-07
### Added
- New translation keys for FlashMessage texts
- Configuration file (phpdoc.xml) for PHP Documentor
- Class `..\Domain\Repository\BackendUserRepository`

### Changed
- Restructured CHANGELOG.md
- Providing Google Authenticator setup tab in user settings module
- Resolving some deprecations
- More detailed PHPDoc blocks
- Code cleanup
- Cease official support for TYPO3 CMS v7

### Deprecated
- Trait `..\Traits\GeneralUtilityObjectManager` will be removed in `v1.2.0`

### Removed
- Trait `..\Traits\GeneralUtilityObjectManagerStatic`

## [1.1.3] - 2019-05-04
### Added
- Class `..\Domain\Repository\FrontendUserRepository`
- File `ext_typoscript_setup.typoscript`

### Changed
- Providing `TYPO3\CMS\Lang\LanguageService` via constructor injection in `..\Controller\Frontend\SetupController`
- Using `..\Domain\Repository\FrontendUserRepository` instead of `TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository` in `..\Controller\Frontend\SetupController`
- Removed object mapping in `setup.typoscript`
- Moved table mapping to `ext_typoscript_setup.typoscript`

## [1.1.2] - 2018-10-15
### Changed
- Constant `AUTH_FAIL_AND_PROCEED` in `..\Service\GoogleAuthenticatorService` set to 100

## [1.1.1] - 2018-10-15
### Changed
- On success, `..\Service\GoogleAuthenticatorService` returns status code 70, instead of 200

## [1.1.0] - 2018-10-15
### Changed
- Compatibility with TYPO3 CMS v9

## [1.0.6] - 2018-10-15
### Added
- Class `..\Domain\Form\FormInterface`
- Class `..\Traits\GeneralUtilityObjectManager`
- Class `..\Utility\TypoScriptUtility`

### Fixed
- Fixed some major bugs which caused the Google Authenticator service to be ignored
- Refactoring

## [1.0.5] - 2018-09-26
### Fixed
- Backend users could not be edited
- QR code kept hidden
- Frontend users could not be created

## [1.0.4] - 2018-07-23
### Added
- Content element/plugin `Google Two-Factor Authentication Setup` to allow users to set up two-factor authentication for their frontend accounts.
- Formular for setting up the two-factor authentication
- Multiple template files

### Changed
- `GoogleQrImageGenerator` renamed to `GoogleQrCodeGenerator`
- `QrImageGeneratorInterface` renamed to `QrCodeGeneratorInterface`
- `..\Hook\TCEMain::getObjectManager()` now requests the `TYPO3\CMS\Extbase\Object\ObjectManager`
via `TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance()` only at the first call, then stores
the reference in, and - when needed - loads it from its appropriate instance variable
- Analogous to this behaves `..\Hook\TCEMain::getGoogleAuthenticatorSetupHandler()`
- `..\Hook\UserSettings::createSecretField()` now only does "one thing";
data retrieval and preparation have been delegated to other functions
- Structure of `ext_localconf.php`, `ext_tables.php`, `be_users.php`,
`fe_users.php` and `sys_template.php` has been improved
- `constants.typoscript` and `setup.typoscript` have been enhanced
to meet frontend requirements

## [1.0.3] - 2018-07-16
### Added
- Base class for unit tests (`..\Tests\Unit\BaseTestCase`)
- Utility to create paths (`..\Utility\PathUtility`)
- Utility to fetch extension meta data (`..\Utility\ExtensionBasicDataUtility`)
- Multiple exception classes
- Multiple data transfer object classes
- Multiple mapper classes
- Multiple struct classes
- Handler for Google Authenticator setup requests

### Changed
- Code structure / refactoring

## [1.0.2] - 2018-07-15
### Changed
- Replace wrong extension link in `README.md`
- Add PHP 7.1+ as dependency in `ext_emconf.php`

## [1.0.1] - 2018-06-17
### Fixed
- Use <img> instead of <f:image> to resolve an issue, with the QR-Code in the backend

## [1.0.0] - 2018-06-17
- Initial development

[Unreleased]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.2.4...HEAD
[1.2.4]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.2.3...v1.2.4
[1.2.3]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.2.2...v1.2.3
[1.2.2]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.2.1...v1.2.2
[1.2.1]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.7...v1.2.0
[1.1.7]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.6...v1.1.7
[1.1.6]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.5...v1.1.6
[1.1.5]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.4...v1.1.5
[1.1.4]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.3...v1.1.4
[1.1.3]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.2...v1.1.3
[1.1.2]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.6...v1.1.0
[1.0.6]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.5...v1.0.6
[1.0.5]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.4...v1.0.5
[1.0.4]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.3...v1.0.4
[1.0.3]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/codeFareith/cf_google_authenticator/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/codeFareith/cf_google_authenticator/releases/tag/v1.0.0
