<?php declare(strict_types=1);
/**
 * Class SetupFormValidator
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

namespace CodeFareith\CfGoogleAuthenticator\Validation\Validator;

use CodeFareith\CfGoogleAuthenticator\Domain\Form\SetupForm;
use CodeFareith\CfGoogleAuthenticator\Utility\GoogleAuthenticatorUtility;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractGenericObjectValidator;
use TYPO3\CMS\Extbase\Validation\Validator\GenericObjectValidator;

$typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
if (version_compare($typo3Version->getBranch(), '12.0', '>=')) {
    class ParentValidatorClass extends AbstractGenericObjectValidator {};
} else {
    class ParentValidatorClass extends GenericObjectValidator {};
}

/**
 * @package CodeFareith\CfGoogleAuthenticator\Validation\Validator
 * @since   1.0.0
 */
class SetupFormValidator
    extends ParentValidatorClass
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function canValidate(mixed $object): bool
    {
        parent::canValidate($object);

        return ($object instanceof SetupForm);
    }

    protected function isValid(mixed $object): void
    {
        parent::isValid($object);

        /** @var SetupForm $object */
        $secret = $object->getSecret();
        $oneTimePassword = $object->getOneTimePassword();

        $isValid = GoogleAuthenticatorUtility::verifyOneTimePassword($secret, $oneTimePassword);

        if ($isValid !== true) {
            $this->addError(
                'The given one-time password is invalid or has expired.',
                1695626410
            );
        }
    }
}
