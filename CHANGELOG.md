# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.3] - 2018-07-16
### Added
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
