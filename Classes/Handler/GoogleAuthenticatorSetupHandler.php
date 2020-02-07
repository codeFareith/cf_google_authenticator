<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticatorSetupHandler
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

namespace CodeFareith\CfGoogleAuthenticator\Handler;

use CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject\GoogleAuthenticatorSettingsDTO;
use CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject\PreProcessFieldArrayDTO;
use CodeFareith\CfGoogleAuthenticator\Domain\Mapper\GoogleAuthenticatorSettingsMapper;
use CodeFareith\CfGoogleAuthenticator\Exception\MissingRequiredField;
use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotInitialized;
use CodeFareith\CfGoogleAuthenticator\Utility\GoogleAuthenticatorUtility;
use ReflectionException;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use function preg_replace;

/**
 * @package CodeFareith\CfGoogleAuthenticator\Handler
 * @since   1.0.0
 */
class GoogleAuthenticatorSetupHandler
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var PreProcessFieldArrayDTO
     */
    private $preProcessFieldArrayDTO;

    /**
     * @var GoogleAuthenticatorSettingsDTO
     */
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
     * @throws ReflectionException
     */
    public function process(PreProcessFieldArrayDTO $preProcessFieldArrayDTO): array
    {
        $result = [];

        $this->setPreProcessFieldArrayDTO($preProcessFieldArrayDTO);

        if ($this->isUsersTable()) {
            $this->initGoogleAuthenticatorSettingsDTO();
            $this->checkFieldArray();

            $result = $this->googleAuthenticatorSettingsDTO
                ->getNewSettings()
                ->toArray(true);
        }

        return $result;
    }

    private function isUsersTable(): bool
    {
        $table = $this->preProcessFieldArrayDTO->getTable();

        return ($table === 'be_users' || $table === 'fe_users');
    }

    private function setPreProcessFieldArrayDTO(PreProcessFieldArrayDTO $preProcessFieldArrayDTO): void
    {
        $this->preProcessFieldArrayDTO = $preProcessFieldArrayDTO;
    }

    /**
     * @throws MissingRequiredField
     * @throws PropertyNotInitialized
     */
    private function initGoogleAuthenticatorSettingsDTO(): void
    {
        $this->googleAuthenticatorSettingsDTO = $this->objectManager->get(GoogleAuthenticatorSettingsDTO::class);

        if ($this->isNewUser() === false) {
            $recordInfo = $this->preProcessFieldArrayDTO->getDataHandler()->recordInfo(
                $this->preProcessFieldArrayDTO->getTable(),
                $this->preProcessFieldArrayDTO->getId(),
                '*'
            );

            if ($recordInfo !== null) {
                $this->googleAuthenticatorSettingsDTO->setOldSettings(
                    GoogleAuthenticatorSettingsMapper::createStructFromArray($recordInfo)
                );
            }
        }

        $fieldArray = $this->preProcessFieldArrayDTO->getFieldArray();

        $this->googleAuthenticatorSettingsDTO->setNewSettings(
            GoogleAuthenticatorSettingsMapper::createStructFromArray($fieldArray)
        );
        $this->googleAuthenticatorSettingsDTO->setOneTimePassword(
            preg_replace(
                '/\s+/',
                '',
                $fieldArray['tx_cfgoogleauthenticator_otp']
            )
        );
    }

    private function checkFieldArray(): void
    {
        if ($this->hasUserEnabledAuthenticator()) {
            $this->processEnableRequest();
        } elseif ($this->isNewUser() === false) {
            if ($this->hasUserDisabledAuthenticator()) {
                $this->processDisableRequest();
            } else {
                $this->keepOldSettings();
            }
        }
    }

    private function isNewUser(): bool
    {
        return ($this->preProcessFieldArrayDTO->getId() === 0);
    }

    private function hasUserEnabledAuthenticator(): bool
    {
        $hasEnabled = $this->googleAuthenticatorSettingsDTO->getNewSettings()->isEnabled();

        if ($this->isNewUser() === false) {
            $hasEnabled &= ($this->googleAuthenticatorSettingsDTO->getOldSettings()->isEnabled() === false);
        }

        return (bool)$hasEnabled;
    }

    private function hasUserDisabledAuthenticator(): bool
    {
        return (
            $this->googleAuthenticatorSettingsDTO->getNewSettings()->isEnabled() === false
            && $this->googleAuthenticatorSettingsDTO->getOldSettings()->isEnabled() === true
        );
    }

    private function processEnableRequest(): void
    {
        $isValid = GoogleAuthenticatorUtility::verifyOneTimePassword(
            $this->googleAuthenticatorSettingsDTO->getNewSettings()->getSecretKey(),
            $this->googleAuthenticatorSettingsDTO->getOneTimePassword()
        );

        if ($isValid) {
            $this->enableAuthenticator();
        } elseif ($this->isNewUser() === false) {
            $this->keepOldSettings();
        }
    }

    private function processDisableRequest(): void
    {
        $isValid = GoogleAuthenticatorUtility::verifyOneTimePassword(
            $this->googleAuthenticatorSettingsDTO->getOldSettings()->getSecretKey(),
            $this->googleAuthenticatorSettingsDTO->getOneTimePassword()
        );

        if ($isValid) {
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
