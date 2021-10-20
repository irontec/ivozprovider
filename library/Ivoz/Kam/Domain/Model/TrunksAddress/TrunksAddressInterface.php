<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

/**
* TrunksAddressInterface
*/
interface TrunksAddressInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getGrp(): int;

    public function getIpAddr(): ?string;

    public function getMask(): int;

    public function getPort(): int;

    public function getTag(): ?string;

    public function setDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): static;

    public function getDdiProviderAddress(): DdiProviderAddressInterface;

    public function isInitialized(): bool;
}
