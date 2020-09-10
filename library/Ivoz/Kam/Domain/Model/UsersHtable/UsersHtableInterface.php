<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersHtableInterface extends EntityInterface
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
     * @return integer
     */
    public function getKeyType(): int;

    /**
     * Get valueType
     *
     * @return integer
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
     * @return integer
     */
    public function getExpires(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
