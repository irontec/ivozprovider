<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TrunksAddressInterface
*/
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
     * @return int
     */
    public function getGrp(): int;

    /**
     * Get ipAddr
     *
     * @return string | null
     */
    public function getIpAddr(): ?string;

    /**
     * Get mask
     *
     * @return int
     */
    public function getMask(): int;

    /**
     * Get port
     *
     * @return int
     */
    public function getPort(): int;

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag(): ?string;

    /**
     * Set ddiProviderAddress
     *
     * @param DdiProviderAddress
     *
     * @return static
     */
    public function setDdiProviderAddress(DdiProviderAddress $ddiProviderAddress): TrunksAddressInterface;

    /**
     * Get ddiProviderAddress
     *
     * @return DdiProviderAddress
     */
    public function getDdiProviderAddress(): DdiProviderAddress;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
