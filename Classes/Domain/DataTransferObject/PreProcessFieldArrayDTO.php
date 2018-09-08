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

namespace CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject;

use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * Data transfer object for preProcessFieldArray-hook-parameters
 *
 * Bundles the arguments of the processDatamap_preProcessFieldArray hook in an
 * object to pass it on to the processing service.
 *
 * @see \CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler
 * @see \CodeFareith\CfGoogleAuthenticator\Hook\TCEMain
 *
 * Class PreProcessFieldArrayDTO
 * @package CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject
 */
class PreProcessFieldArrayDTO
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var array */
    protected $fieldArray;
    /** @var string */
    protected $table;
    /** @var int */
    protected $id;
    /** @var DataHandler */
    protected $dataHandler;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function init(
        array &$fieldArray,
        string $table,
        int $id,
        DataHandler $dataHandler
    ): void
    {
        $this->fieldArray = &$fieldArray;
        $this->table = $table;
        $this->id = $id;
        $this->dataHandler = $dataHandler;
    }

    public function getFieldArray(): array
    {
        return $this->fieldArray;
    }

    public function setFieldArray(array &$fieldArray): void
    {
        $this->fieldArray = &$fieldArray;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDataHandler(): DataHandler
    {
        return $this->dataHandler;
    }

    public function setDataHandler(DataHandler $dataHandler): void
    {
        $this->dataHandler = $dataHandler;
    }
}
