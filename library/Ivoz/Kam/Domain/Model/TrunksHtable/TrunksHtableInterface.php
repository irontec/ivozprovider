<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* TrunksHtableInterface
*/
interface TrunksHtableInterface extends EntityInterface
{
    /**
     * Get keyName
     *
     * @return string
     */
    public function getKeyName(): string;

    /**
     * Get keyType
     *
     * @return int
     */
    public function getKeyType(): int;

    /**
     * Get valueType
     *
     * @return int
     */
    public function getValueType(): int;

    /**
     * Get keyValue
     *
     * @return string
     */
    public function getKeyValue(): string;

    /**
     * Get expires
     *
     * @return int
     */
    public function getExpires(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
