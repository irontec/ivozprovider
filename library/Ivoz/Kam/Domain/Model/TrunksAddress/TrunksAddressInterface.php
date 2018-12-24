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
     * Get grp
     *
     * @return integer
     */
    public function getGrp();

    /**
     * Get ipAddr
     *
     * @return string | null
     */
    public function getIpAddr();

    /**
     * Get mask
     *
     * @return integer
     */
    public function getMask();

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort();

    /**
     * Get tag
     *
     * @return string | null
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
