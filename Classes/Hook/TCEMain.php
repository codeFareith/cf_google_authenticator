<?php declare(strict_types=1);
/**
 * Class TCEMain
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

namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject\PreProcessFieldArrayDTO;
use CodeFareith\CfGoogleAuthenticator\Exception\MissingRequiredField;
use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotInitialized;
use CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler;
use CodeFareith\CfGoogleAuthenticator\Traits\GeneralUtilityObjectManager;
use ReflectionException;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use function array_merge;

/**
 * Hook for the TYPO3 Core Engine
 *
 * This class hooks into the TYPO3 Core Engine to handle
 * the activation / deactivation of the Google Authenticator,
 * in frontend and backend accounts, via the TYPO3 backend.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Hook
 * @since   1.0.0
 */
class TCEMain
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Traits
    \*─────────────────────────────────────────────────────────────────────────────*/
    use GeneralUtilityObjectManager;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var GoogleAuthenticatorSetupHandler
     */
    protected $googleAuthenticatorSetupHandler;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @noinspection MoreThanThreeArgumentsInspection
     *
     * @param mixed      $fieldArray
     * @param string|int $id
     *
     * @throws MissingRequiredField
     * @throws PropertyNotInitialized
     * @throws ReflectionException
     */
    public function processDatamap_preProcessFieldArray(
        array &$fieldArray,
        string $table,
        $id,
        DataHandler $dataHandler
    ): void
    {
        $otpInFieldArray = &$fieldArray['tx_cfgoogleauthenticator_otp'];
        $otpInPostData = $_POST['data']['be_users']['tx_cfgoogleauthenticator_otp'];

        if ($otpInFieldArray === null && $otpInPostData !== null) {
            $otpInFieldArray = $otpInPostData;
        }

        $preProcessFieldArrayDTO = $this->getPreProcessFieldArrayDTO($fieldArray, $table, (int) $id, $dataHandler);
        $result = $this->getGoogleAuthenticatorSetupHandler()->process($preProcessFieldArrayDTO);

        $fieldArray = array_merge($fieldArray, $result);
    }

    /**
     * @noinspection MoreThanThreeArgumentsInspection
     *
     * @param mixed $fieldArray
     *
     * @return PreProcessFieldArrayDTO
     */
    private function getPreProcessFieldArrayDTO(
        array &$fieldArray,
        string $table,
        int $id,
        DataHandler $dataHandler
    ): PreProcessFieldArrayDTO
    {
        /** @var PreProcessFieldArrayDTO $preProcessFieldArrayDTO */
        $preProcessFieldArrayDTO = $this->objectManager()->get(
            PreProcessFieldArrayDTO::class,
            $fieldArray,
            $table,
            $id,
            $dataHandler
        );

        return $preProcessFieldArrayDTO;
    }

    protected function getGoogleAuthenticatorSetupHandler(): GoogleAuthenticatorSetupHandler
    {
        if ($this->googleAuthenticatorSetupHandler === null) {
            $this->googleAuthenticatorSetupHandler = $this->objectManager()->get(
                GoogleAuthenticatorSetupHandler::class
            );
        }

        return $this->googleAuthenticatorSetupHandler;
    }
}
