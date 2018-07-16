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
namespace CodeFareith\CfGoogleAuthenticator\Domain\Mapper;

use CodeFareith\CfGoogleAuthenticator\Exception\MissingRequiredField;
use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotInitialized;

abstract class AbstractMapper implements MapperInterface
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * Contains all the fields/keys the array should have in order to create the desired struct.
     * Should be defined in child class.
     *
     * @var string[]|null
     */
    protected static $requiredFields;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * Check if the given array has all fields/keys defined in static::requiredFields.
     *
     * @param mixed[] $data
     */
    final public static function hasRequiredFields(array $data): bool
    {
        return empty(self::getMissingFields($data));
    }

    /**
     * Get all fields/keys defined in static::requiredFields, but missing in the given array
     *
     * @param mixed[] $data
     */
    final public static function getMissingFields(array $data): array
    {
        return \array_values(
            \array_diff(
                static::$requiredFields,
                \array_keys($data)
            )
        );
    }

    /**
     * Create a struct using data from the given array.
     * Any child class has to initialize static::requiredFields - otherwise an exception is thrown.
     *
     * @param mixed[] $data
     * @throws MissingRequiredField
     * @throws PropertyNotInitialized
     */
    final public static function createStructFromArray(array $data)
    {
        if(static::$requiredFields === null) {
            throw new PropertyNotInitialized('requiredFields', static::class);
        }

        if(self::hasRequiredFields($data) === false) {
            $missingFields = self::getMissingFields($data);
            $previous = null;

            while($next = array_pop($missingFields)) {
                $previous = new MissingRequiredField($next, $previous);
            }

            throw $previous;
        }

        return static::mapArrayOnStruct($data);
    }

    /**
     * Map array values to struct.
     * Should be defined in child class.
     *
     * @param mixed[] $data
     */
    abstract protected static function mapArrayOnStruct(array $data);
}