<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddres;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TrunksAddresInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set grp
     *
     * @param integer $grp
     *
     * @return self
     */
    public function setGrp($grp);

    /**
     * Get grp
     *
     * @return integer
     */
    public function getGrp();

    /**
     * Set ipAddr
     *
     * @param string $ipAddr
     *
     * @return self
     */
    public function setIpAddr($ipAddr = null);

    /**
     * Get ipAddr
     *
     * @return string
     */
    public function getIpAddr();

    /**
     * Set mask
     *
     * @param integer $mask
     *
     * @return self
     */
    public function setMask($mask);

    /**
     * Get mask
     *
     * @return integer
     */
    public function getMask();

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port);

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort();

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

}

