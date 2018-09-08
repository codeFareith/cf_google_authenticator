# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).



## [Unreleased]

- nothing, yet



## [1.0.4] - 2018-07-23

### Added

#### Features

- the content element/plugin `Google Two-Factor Authentication Setup`
is now available, which allows users to set up Google 2FA for
their frontend accounts.


#### Files

- Classes/Controller/Frontend/SetupController.php
- Classes/Domain/Form/SetupForm.php
- Classes/Domain/Model/BackendUser.php
- Classes/Domain/Model/FrontendUser.php
- Classes/Validation/Validator/SetupFormValidator.php
- Configuration/TCA/Overrides/tt_content.php
- Resources/Private/Layouts/Frontend/Default.html
- Resources/Private/Partials/Backend/Form/OneTimePassword.html
- Resources/Private/Partials/Backend/Form/QrCode.html
- Resources/Private/Partials/Backend/Form/Secret.html
- Resources/Private/Partials/Frontend/Form/OneTimePassword.html
- Resources/Private/Partials/Frontend/Form/QrCode.html
- Resources/Private/Partials/Frontend/Form/Secret.html
- Resources/Private/Partials/Shared/Alert.html
- Resources/Private/Partials/Shared/FlashMessages.html
- Resources/Private/Partials/Shared/Icon.html
- Resources/Private/Partials/Shared/ValidationResults.html
- Resources/Private/Templates/Backend/UserSettings.html
- Resources/Private/Templates/Frontend/Setup/Index.html


### Changed

- `GoogleQrImageGenerator` renamed to `GoogleQrCodeGenerator`

- `QrImageGeneratorInterface` renamed to `QrCodeGeneratorInterface`

- `Classes/Hook/TCEMain::getObjectManager()` now requests the `ObjectManager`
via `GeneralUtility::makeInstance()` only at the first call, then stores
the reference in, and - when needed - loads it from its appropriate instance variable.

- analogous to this behaves `getGoogleAuthenticatorSetupHandler()`.

- `Classes/Hook/UserSettings::createSecretField()` now only does "one thing".
Data retrieval and preparation have been delegated to other functions.

- structure of `ext_localconf.php`, `ext_tables.php`, `be_users.php`,
`fe_users.php` and `sys_template.php` has been improved.

- `constants.typoscript` and `setup.typoscript` have been enhanced
to meet frontend requirements



## [1.0.3] - 2018-07-16

### Added

#### Files

- Tests/Unit/BaseTestCase.php
- Tests/Unit/Utility/PathUtilityTest.php
- Classes/Domain/DataTransferObject/GoogleAuthenticatorSettingsDTO.php
- Classes/Domain/DataTransferObject/PreProcessFieldArrayDTO.php
- Classes/Domain/Immutable/ImmutableInterface.php
- Classes/Domain/Mapper/MapperInterface.php
- Classes/Domain/Mapper/AbstractMapper.php
- Classes/Domain/Mapper/GoogleAuthenticatorSettingsMapper.php
- Classes/Domain/Struct/StructInterface.php
- Classes/Domain/Struct/AbstractStruct.php
- Classes/Domain/Struct/GoogleAuthenticatorSettings.php
- Classes/Domain/Exception/MissingRequiredField.php
- Classes/Domain/Exception/PropertyNotFound.php
- Classes/Domain/Exception/PropertyNotInitialized.php
- Classes/Domain/Handler/GoogleAuthenticatorSetupHandler.php
- Classes/Domain/Utility/ExtensionBasicDataUtility.php
- Classes/Domain/Utility/PathUtility.php


### Changed

- A lot of refactoring

- Apart from the code structure, nothing has changed significantly



## [1.0.2] - 2018-07-15

### Changed

- Replace wrong extension link in README.md

- Add PHP 7.1+ as dependency in ext_emconf.php



## [1.0.1] - 2018-06-17

### Changed

- Use <img> instead of <f:image> to resolve an issue, with the QR-Code in the backend



## [1.0.0] - 2018-06-17

- Initial development
