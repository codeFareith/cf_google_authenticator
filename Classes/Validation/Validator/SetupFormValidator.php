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
use TYPO3\CMS\Extbase\Validation\Validator\GenericObjectValidator;

/**
 * @package CodeFareith\CfGoogleAuthenticator\Validation\Validator
 * @since   1.0.0
 */
class SetupFormValidator
    extends GenericObjectValidator
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function canValidate($object): bool
    {
        parent::canValidate($object);

        return ($object instanceof SetupForm);
    }

    public function isValid($object): bool
    {
        parent::isValid($object);

        $result = true;

        /** @var SetupForm $object */
        $secret = $object->getSecret();
        $oneTimePassword = $object->getOneTimePassword();

        $isValid = GoogleAuthenticatorUtility::verifyOneTimePassword($secret, $oneTimePassword);

        if ($isValid !== true) {
            $this->addError(
                'The given one-time password is invalid or has expired.',
                'otp_invalid'
            );

            $result = false;
        }

        return $result;
    }
}
