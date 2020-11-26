<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersAddressInterface
*/
interface UsersAddressInterface extends EntityInterface
{

    public function setIpAddr(string $ipAddr = null): UsersAddressInterface;

    public function setMask(int $mask = null): UsersAddressInterface;

    /**
     * Get sourceAddress
     *
     * @return string
     */
    public function getSourceAddress(): string;

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
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
