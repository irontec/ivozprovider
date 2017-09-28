<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersDomainAttrInterface extends EntityInterface
{
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

