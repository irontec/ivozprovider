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
    public function getGrp(): int;

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
    public function getMask(): int;

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort(): int;

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
     * @return static
     */
    public function setDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress);

    /**
     * Get ddiProviderAddress
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface
     */
    public function getDdiProviderAddress();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
