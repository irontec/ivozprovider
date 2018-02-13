<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersHtableInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set keyName
     *
     * @param string $keyName
     *
     * @return self
     */
    public function setKeyName($keyName);

    /**
     * Get keyName
     *
     * @return string
     */
    public function getKeyName();

    /**
     * Set keyType
     *
     * @param integer $keyType
     *
     * @return self
     */
    public function setKeyType($keyType);

    /**
     * Get keyType
     *
     * @return integer
     */
    public function getKeyType();

    /**
     * Set valueType
     *
     * @param integer $valueType
     *
     * @return self
     */
    public function setValueType($valueType);

    /**
     * Get valueType
     *
     * @return integer
     */
    public function getValueType();

    /**
     * Set keyValue
     *
     * @param string $keyValue
     *
     * @return self
     */
    public function setKeyValue($keyValue);

    /**
     * Get keyValue
     *
     * @return string
     */
    public function getKeyValue();

    /**
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    public function setExpires($expires);

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

}

