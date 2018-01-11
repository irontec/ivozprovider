<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersDomainAttrInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return UsersDomainAttrDto
     */
    public static function createDto();

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(\Ivoz\Core\Application\DataTransferObjectInterface $dto);

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(\Ivoz\Core\Application\DataTransferObjectInterface $dto);

    /**
     * @return UsersDomainAttrDto
     */
    public function toDto($depth = 0);

    /**
     * Set did
     *
     * @param string $did
     *
     * @return self
     */
    public function setDid($did);

    /**
     * Get did
     *
     * @return string
     */
    public function getDid();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Get type
     *
     * @return integer
     */
    public function getType();

    /**
     * Set value
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue($value);

    /**
     * Get value
     *
     * @return string
     */
    public function getValue();

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return self
     */
    public function setLastModified($lastModified);

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified();

}

