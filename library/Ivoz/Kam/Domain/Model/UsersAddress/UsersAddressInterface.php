<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* UsersAddressInterface
*/
interface UsersAddressInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setIpAddr(?string $ipAddr = null): static;

    public function setMask(?int $mask = null): static;

    public function getSourceAddress(): string;

    public function getIpAddr(): ?string;

    public function getMask(): int;

    public function getPort(): int;

    public function getTag(): ?string;

    public function getDescription(): ?string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
