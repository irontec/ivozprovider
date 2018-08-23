<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TrunksAddressInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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

    /**
     * Set ddiProviderAddress
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress
     *
     * @return self
     */
    public function setDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress);

    /**
     * Get ddiProviderAddress
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface
     */
    public function getDdiProviderAddress();

}

