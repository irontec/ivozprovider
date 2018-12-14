<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersLocationAttrInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid();

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Get domain
     *
     * @return string | null
     */
    public function getDomain();

    /**
     * Get aname
     *
     * @return string
     */
    public function getAname();

    /**
     * Get atype
     *
     * @return integer
     */
    public function getAtype();

    /**
     * Get avalue
     *
     * @return string
     */
    public function getAvalue();

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified();
}
