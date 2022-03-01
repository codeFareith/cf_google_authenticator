<?php declare(strict_types=1);
/**
 * Class PreProcessFieldArrayDTO
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2022 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject;

use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * Data transfer object for preProcessFieldArray-hook-parameters
 *
 * Bundles the arguments of the processDatamap_preProcessFieldArray hook in an
 * object to pass it on to the processing service.
 *
 * @see     \CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler
 * @see     \CodeFareith\CfGoogleAuthenticator\Hook\TCEMain
 *
 * @package CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject
 * @since   1.0.0
 */
class PreProcessFieldArrayDTO
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var array
     */
    protected $fieldArray;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var DataHandler
     */
    protected $dataHandler;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(
        array &$fieldArray,
        string $table,
        int $id,
        DataHandler $dataHandler
    )
    {
        $this->setFieldArray($fieldArray);
        $this->setTable($table);
        $this->setId($id);
        $this->setDataHandler($dataHandler);
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
