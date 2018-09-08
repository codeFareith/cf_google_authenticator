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

namespace CodeFareith\CfGoogleAuthenticator\Domain\Struct;

use CodeFareith\CfGoogleAuthenticator\Exception\PropertyNotFound;

abstract class AbstractStruct implements StructInterface
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string[][] */
    protected static $mapping;

    /** @var \ReflectionClass */
    private $reflection;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @throws \ReflectionException
     */
    final public function toArray(): array
    {
        $array = [];

        $properties = $this->getReflectionClass()
            ->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);

            $key = static::$mapping[$property->getName()] ?? $property->getName();
            $value = $property->getValue($this);

            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * @param mixed $offset
     * @return bool
     * @throws \ReflectionException
     */
    public function offsetExists($offset): bool
    {
        return $this->getReflectionClass()
            ->hasProperty($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     * @throws PropertyNotFound
     * @throws \ReflectionException
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new PropertyNotFound($offset, __CLASS__);
        }

        return $this->getReflectionClass()
            ->getProperty($offset)
            ->getValue($this);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws PropertyNotFound
     * @throws \ReflectionException
     */
    public function offsetSet($offset, $value): void
    {
        if (!$this->offsetExists($offset)) {
            throw new PropertyNotFound($offset, __CLASS__);
        }

        $this->getReflectionClass()
            ->getProperty($offset)
            ->setValue($this, $value);
    }

    /**
     * @param mixed $offset
     * @throws PropertyNotFound
     * @throws \ReflectionException
     */
    public function offsetUnset($offset): void
    {
        if (!$this->offsetExists($offset)) {
            throw new PropertyNotFound($offset, __CLASS__);
        }

        $this->getReflectionClass()
            ->getProperty($offset)
            ->setValue($this, null);
    }

    /**
     * @throws \ReflectionException
     */
    private function getReflectionClass(): \ReflectionClass
    {
        if ($this->reflection === null) {
            $this->reflection = new \ReflectionClass(static::class);
        }

        return $this->reflection;
    }
}
