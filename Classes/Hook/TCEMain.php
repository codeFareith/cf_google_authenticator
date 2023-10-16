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
use CodeFareith\CfGoogleAuthenticator\Event\CollectAllowedTablesEvent;
use CodeFareith\CfGoogleAuthenticator\Exception\MissingRequiredField;
use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotInitialized;
use CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler;
use Psr\EventDispatcher\EventDispatcherInterface;
use ReflectionException;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    protected EventDispatcherInterface $eventDispatcher;

    /**
     * @var GoogleAuthenticatorSetupHandler
     */
    protected $googleAuthenticatorSetupHandler;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

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
        $event = new CollectAllowedTablesEvent(
            [
                'fe_users',
            ]
        );
        $this->eventDispatcher->dispatch($event);

        if (!in_array($table, $event->getTables(), true)) {
            return;
        }

        $otpInFieldArray = &$fieldArray['tx_cfgoogleauthenticator_otp'];
        $otpInPostData = $_POST['data'][$table]['tx_cfgoogleauthenticator_otp'] ?? null;

        if ($otpInFieldArray === null && $otpInPostData !== null) {
            $otpInFieldArray = $otpInPostData;
        }

		$otpInFieldArray2 = &$fieldArray['tx_cfgoogleauthenticator_secret'];
		$otpInPostData2 = $_POST['data'][$table]['tx_cfgoogleauthenticator_secret'] ?? null;

        if ($otpInFieldArray2 === null && $otpInPostData2 !== null) {
            $otpInFieldArray2 = $otpInPostData2;
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
        $preProcessFieldArrayDTO = GeneralUtility::makeInstance(
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
            $this->googleAuthenticatorSetupHandler = GeneralUtility::makeInstance(
                GoogleAuthenticatorSetupHandler::class
            );
        }

        return $this->googleAuthenticatorSetupHandler;
    }
}
