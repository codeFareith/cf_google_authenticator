# Google Authenticator

![GitHub license](https://img.shields.io/github/license/codeFareith/cf_google_authenticator.svg?style=flat-square&label=License)
![GitHub release](https://img.shields.io/github/release/codeFareith/cf_google_authenticator.svg?style=flat-square&stable)
![GitHub pre-release)](https://img.shields.io/github/tag-pre/codeFareith/cf_google_authenticator.svg?style=flat-square&label=develop)
[![Build Status](https://travis-ci.org/codeFareith/cf_google_authenticator.svg?branch=master)](https://travis-ci.org/codeFareith/cf_google_authenticator)
![Codecov coverage](https://img.shields.io/codecov/c/github/codefareith/cf_google_authenticator.svg?style=flat-square)
![Scrutinizer code quality](https://img.shields.io/scrutinizer/quality/g/codeFareith/cf_google_authenticator.svg?style=flat-square)
![Requires.io requirements](https://img.shields.io/requires/github/codeFareith/cf_google_authenticator.svg?style=flat-square)
<!-- ![Libraries.io dependencies](https://img.shields.io/librariesio/github/codeFareith/cf_google_authenticator.svg?style=flat-square) -->

> TYPO3 CMS extension to enable Google 2FA (two-factor authentication) for frontend accounts.

<br>

[![Donate via PayPal](https://img.shields.io/badge/Donate-%230070ba.svg?style=for-the-badge&logo=paypal&labelColor=eeeeee)](https://www.paypal.me/fareith)


## Getting Started

Follow these instructions to enable Google 2FA in your TYPO3 CMS installation.

## Installation
The extension needs to be installed as any other extension of TYPO3 CMS:
1. Switch to the module “Extension Manager”.
2. Get the extension
    1. **Get it from the Extension Manager**: Press the “Retrieve/Update” button, search for the extension key cf_google_authenticator and import the extension from the repository.
    2. **Get it from typo3.org**: You can always get the current version from [https://extensions.typo3.org/extension/cf_google_authenticator/](https://extensions.typo3.org/extension/cf_google_authenticator/) by downloading either the t3x or zip version. Upload the file afterward in the Extension Manager.
    3. **Get it from packagist.org**: Add this extension as dependency using Composer: `composer require codefareith/cf-google-authenticator`
3. Change the extension configuration to your needs

## Update
If you update from version before 1.3.0, you need to run the Upgrade Wizard to move the existing 2FA configuration to
the new data structure in TYPO3 v11 and above.

1. **If TYPO3 suggests it, be sure NOT to rename or drop legacy columns `tx_cfgoogleauthenticator_enabled` and
   `tx_cfgoogleauthenticator_secret`** for table `be_users` (yet)
2. Switch to the module "Upgrade" within "Admin Tools"
3. Click the button "Upgrade Wizard"
4. Run upgrade wizard "Migrate TOTP settings from be_users"

At this point, you may safely rename/drop legacy columns as described above.

## Usage
After installing and activating the extension you'll be able to activate 2FA for frontend users.

### Frontend
In order to offer frontend users the possibility to secure their accounts via two-factor authentication, this condition must be met:

1. via the backend, the necessary plugin must be placed on a page provided for this purpose:
    - Select a preferred page via the page module and make sure that it is only accessible for logged-in frontend users.
    - Then create a new content element on the aforementioned page.
    - Under the "Plug-Ins" tab, select "General Plug-In".
    - In the next step open the next tab called "Plug-Ins".
    - Select "Google Two-Factor-Authentication Setup" from the dropdown and click on save. Done!

***

## History
See [CHANGELOG.md](CHANGELOG.md)

## License
[GNU Public License](http://opensource.org/licenses/gpl-license.php)

----

<!-- GITHUB SOCIAL -->
![GitHub followers](https://img.shields.io/github/followers/codeFareith.svg?style=social)
![GitHub forks](https://img.shields.io/github/forks/codeFareith/cf_google_authenticator.svg?style=social)
![GitHub stars](https://img.shields.io/github/stars/codeFareith/cf_google_authenticator.svg?style=social)
![GitHub watchers](https://img.shields.io/github/watchers/codeFareith/cf_google_authenticator.svg?style=social)

![Twitter Follow](https://img.shields.io/twitter/follow/codeFareith.svg?label=%40codeFareith&style=social)

----

![GitHub issues](https://img.shields.io/github/issues-raw/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub closed issues](https://img.shields.io/github/issues-closed-raw/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub closed pull requests](https://img.shields.io/github/issues-pr-closed-raw/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub downloads](https://img.shields.io/github/downloads/codeFareith/cf_google_authenticator/total.svg?style=flat-square&logo=github)
![GitHub contributors](https://img.shields.io/github/contributors/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)

<!-- GITHUB INSIGHTS -->
![GitHub commit activity](https://img.shields.io/github/commit-activity/m/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub last commit](https://img.shields.io/github/last-commit/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub release date](https://img.shields.io/github/release-date/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)
![GitHub release date pre](https://img.shields.io/github/release-date-pre/codeFareith/cf_google_authenticator.svg?style=flat-square&logo=github)

<!-- METADATA -->
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codeFareith/cf_google_authenticator.svg?style=flat-square)
![GitHub repo size](https://img.shields.io/github/repo-size/codeFareith/cf_google_authenticator.svg?style=flat-square)
