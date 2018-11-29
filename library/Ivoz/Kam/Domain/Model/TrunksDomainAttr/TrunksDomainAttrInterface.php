<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TrunksDomainAttrInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get did
     *
     * @return string
     */
    public function getDid();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get type
     *
     * @return integer
     */
    public function getType();

    /**
     * Get value
     *
     * @return string
     */
    public function getValue();

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified();
}
