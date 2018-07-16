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
namespace CodeFareith\CfGoogleAuthenticator\Handler;

use CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject\GoogleAuthenticatorSettingsDTO;
use CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject\PreProcessFieldArrayDTO;
use CodeFareith\CfGoogleAuthenticator\Domain\Mapper\GoogleAuthenticatorSettingsMapper;
use CodeFareith\CfGoogleAuthenticator\Exception\MissingRequiredField;
use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotInitialized;
use CodeFareith\CfGoogleAuthenticator\Utility\GoogleAuthenticatorUtility;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

class GoogleAuthenticatorSetupHandler
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var ObjectManagerInterface */
    protected $objectManager;
    /** @var PreProcessFieldArrayDTO */
    private $preProcessFieldArrayDTO;
    /** @var GoogleAuthenticatorSettingsDTO */
    private $googleAuthenticatorSettingsDTO;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @throws MissingRequiredField
     * @throws PropertyNotInitialized
     * @throws \ReflectionException
     */
    public function process(PreProcessFieldArrayDTO $preProcessFieldArrayDTO): array
    {
        $result = [];

        $this->setPreProcessFieldArrayDTO($preProcessFieldArrayDTO);

        if($this->isUsersTable()) {
            $this->initGoogleAuthenticatorSettingsDTO();
            $this->checkFieldArray();

            $result = $this->googleAuthenticatorSettingsDTO->getNewSettings()->toArray();
        }

        return $result;
    }

    private function setPreProcessFieldArrayDTO(PreProcessFieldArrayDTO $preProcessFieldArrayDTO): void
    {
        $this->preProcessFieldArrayDTO = $preProcessFieldArrayDTO;
    }

    private function isUsersTable(): bool
    {
        $table = $this->preProcessFieldArrayDTO->getTable();
        return ($table === 'be_users' || $table === 'fe_users');
    }

    /**
     * @throws MissingRequiredField
     * @throws PropertyNotInitialized
     */
    private function initGoogleAuthenticatorSettingsDTO(): void
    {
        $recordInfo = $this->preProcessFieldArrayDTO->getDataHandler()->recordInfo(
            $this->preProcessFieldArrayDTO->getTable(),
            $this->preProcessFieldArrayDTO->getId(),
            '*'
        );

        $fieldArray = $this->preProcessFieldArrayDTO->getFieldArray();

        $this->googleAuthenticatorSettingsDTO = $this->objectManager->get(GoogleAuthenticatorSettingsDTO::class);
        $this->googleAuthenticatorSettingsDTO->setOldSettings(
            GoogleAuthenticatorSettingsMapper::createStructFromArray($recordInfo)
        );
        $this->googleAuthenticatorSettingsDTO->setNewSettings(
            GoogleAuthenticatorSettingsMapper::createStructFromArray($fieldArray)
        );
        $this->googleAuthenticatorSettingsDTO->setOneTimePassword(
            \preg_replace(
                '/\s+/',
                '',
                $fieldArray['tx_cfgoogleauthenticator_otp']
            )
        );
    }

    private function checkFieldArray(): void
    {
        if($this->hasUserEnabledAuthenticator()) {
            $this->processEnableRequest();
        } elseif($this->hasUserDisabledAuthenticator()) {
            $this->processDisableRequest();
        }  else {
            $this->keepOldSettings();
        }
    }

    private function hasUserEnabledAuthenticator(): bool
    {
        return (
            $this->googleAuthenticatorSettingsDTO->getOldSettings()->isEnabled() === false
            && $this->googleAuthenticatorSettingsDTO->getNewSettings()->isEnabled() === true
        );
    }

    private function hasUserDisabledAuthenticator(): bool
    {
        return (
            $this->googleAuthenticatorSettingsDTO->getOldSettings()->isEnabled() === true
            && $this->googleAuthenticatorSettingsDTO->getNewSettings()->isEnabled() === false
        );
    }

    private function processEnableRequest(): void
    {
        $isValid = GoogleAuthenticatorUtility::verifyOneTimePassword(
            $this->googleAuthenticatorSettingsDTO->getNewSettings()->getSecretKey(),
            $this->googleAuthenticatorSettingsDTO->getOneTimePassword()
        );

        if($isValid) {
            $this->enableAuthenticator();
        } else {
            $this->keepOldSettings();
        }
    }

    private function processDisableRequest(): void
    {
        $isValid = GoogleAuthenticatorUtility::verifyOneTimePassword(
            $this->googleAuthenticatorSettingsDTO->getOldSettings()->getSecretKey(),
            $this->googleAuthenticatorSettingsDTO->getOneTimePassword()
        );

        if($isValid) {
            $this->disableAuthenticator();
        } else {
            $this->keepOldSettings();
        }
    }

    private function enableAuthenticator(): void
    {
        $newSettings = $this->googleAuthenticatorSettingsDTO->getNewSettings();
        $newSettings->setEnabled(true);
    }

    private function disableAuthenticator(): void
    {
        $newSettings = $this->googleAuthenticatorSettingsDTO->getNewSettings();
        $newSettings->setEnabled(false);
        $newSettings->setSecretKey('');
    }

    private function keepOldSettings(): void
    {
        $oldSettings = $this->googleAuthenticatorSettingsDTO->getOldSettings();
        $newSettings = $this->googleAuthenticatorSettingsDTO->getNewSettings();

        $newSettings->setEnabled($oldSettings->isEnabled());
        $newSettings->setSecretKey($oldSettings->getSecretKey());
    }
}