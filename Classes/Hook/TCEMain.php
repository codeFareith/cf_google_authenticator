<?php
/**
 * @author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */
namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Utility\GoogleAuthenticatorUtility;
use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * Hook for the TYPO3 Core Engine
 *
 * This class hooks into the TYPO3 Core Engine to handle
 * the activation / deactivation of the Google Authenticator,
 * in frontend and backend accounts, via the TYPO3 backend.
 *
 * Class TCEMain
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 */
class TCEMain
{
    /**
     * Process the submitted data and decide wether
     * to enable / disable the Google Authenticator
     * for the given user.
     *
     * @param array $fieldArray
     * @param string $table
     * @param string $id
     * @param DataHandler $pObj
     */
    public function processDatamap_preProcessFieldArray(array &$fieldArray, string $table, string $id, DataHandler $pObj): void
    {
        if(
            ($table === 'be_users' || $table === 'fe_users')
            && $fieldArray['tx_cfgoogleauthenticator_enable'] !== null
        ) {
            $record = $pObj->recordInfo($table, $id, '*');

            $isEnabledInUser = (bool)$record['tx_cfgoogleauthenticator_enable'];
            $secretKeyInUser = \str_replace('-', '', $record['tx_cfgoogleauthenticator_secret']);

            $isEnabledInForm = (bool)$fieldArray['tx_cfgoogleauthenticator_enable'];
            $secretKeyInForm = \str_replace('-', '', $fieldArray['tx_cfgoogleauthenticator_secret']);
            $oneTimePwInForm = \preg_replace('/\s+/', '', $fieldArray['tx_cfgoogleauthenticator_otp']);

            // check if 2FA is enabled for the user
            if($isEnabledInUser === true) {
                // check if the user tries to disable 2FA
                if($isEnabledInForm === false) {
                    // to disable 2FA, the user has to enter a valid 2FA code
                    if(GoogleAuthenticatorUtility::verifyOneTimePassword($secretKeyInUser, $oneTimePwInForm) === true) {
                        // if the 2FA code is valid, disable 2FA and reset 2FA id
                        $isEnabledInUser = $isEnabledInForm;
                        $secretKeyInUser = '';
                    } else {
                        // if the 2FA code is invalid, keep 2FA enabled
                        $isEnabledInUser = 1;
                    }
                }
            } else {
                // check if user wants to enable 2FA
                if($isEnabledInForm === true) {
                    // to enable 2FA, the user has to enter a valid 2FA code
                    if(GoogleAuthenticatorUtility::verifyOneTimePassword($secretKeyInForm, $oneTimePwInForm) === true) {
                        // if the 2FA code is valid, enable 2FA and save 2FA id
                        $isEnabledInUser = $isEnabledInForm;
                        $secretKeyInUser = $secretKeyInForm;
                    } else {
                        // if the 2FA code is invalid, disable 2FA and reset 2FA id
                        $isEnabledInUser = 0;
                        $secretKeyInUser = '';
                    }
                } else {
                    // if user keeps 2FA disabled, reset submitted 2FA id
                    $isEnabledInUser = $isEnabledInForm;
                    $secretKeyInUser = '';
                }
            }

            $fieldArray['tx_cfgoogleauthenticator_enable'] = (int)$isEnabledInUser;
            $fieldArray['tx_cfgoogleauthenticator_secret'] = $secretKeyInUser;
        }
    }
}