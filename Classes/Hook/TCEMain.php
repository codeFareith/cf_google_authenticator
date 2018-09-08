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

use CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject\PreProcessFieldArrayDTO;
use CodeFareith\CfGoogleAuthenticator\Exception\MissingRequiredField;
use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotInitialized;
use CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

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
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var ObjectManager */
    protected $objectManager;

    /** @var GoogleAuthenticatorSetupHandler */
    protected $googleAuthenticatorSetupHandler;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @throws MissingRequiredField
     * @throws PropertyNotInitialized
     * @throws \ReflectionException
     */
    public function processDatamap_preProcessFieldArray(
        array &$fieldArray,
        string $table,
        $id,
        DataHandler $dataHandler
    ): void
    {
        $preProcessFieldArrayDTO = $this->getObjectManager()->get(PreProcessFieldArrayDTO::class);
        $preProcessFieldArrayDTO->init($fieldArray, $table, (int)$id, $dataHandler);

        $result = $this->getGoogleAuthenticatorSetupHandler()->process($preProcessFieldArrayDTO);

        $fieldArray = \array_merge($fieldArray, $result);
    }

    protected function getObjectManager(): ObjectManager
    {
        if ($this->objectManager === null) {
            $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        }

        return $this->objectManager;
    }

    protected function getGoogleAuthenticatorSetupHandler(): GoogleAuthenticatorSetupHandler
    {
        if ($this->googleAuthenticatorSetupHandler === null) {
            $this->googleAuthenticatorSetupHandler = $this->getObjectManager()->get(GoogleAuthenticatorSetupHandler::class);
        }

        return $this->googleAuthenticatorSetupHandler;
    }
}
