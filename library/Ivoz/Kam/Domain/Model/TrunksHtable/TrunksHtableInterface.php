<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TrunksHtableInterface extends EntityInterface
{
    /**
     * Get keyName
     *
     * @return string
     */
    public function getKeyName();

    /**
     * Get keyType
     *
     * @return integer
     */
    public function getKeyType();

    /**
     * Get valueType
     *
     * @return integer
     */
    public function getValueType();

    /**
     * Get keyValue
     *
     * @return string
     */
    public function getKeyValue();

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();
}
