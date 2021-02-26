<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress;

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

    public function getGrp(): int;

    public function getIpAddr(): ?string;

    public function getMask(): int;

    public function getPort(): int;

    public function getTag(): ?string;

    public function setDdiProviderAddress(DdiProviderAddress $ddiProviderAddress): static;

    public function getDdiProviderAddress(): DdiProviderAddress;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
