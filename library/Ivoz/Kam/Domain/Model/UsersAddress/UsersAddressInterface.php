<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersAddressInterface extends EntityInterface
{
    public function setIpAddr($ipAddr = null);

    public function setMask($mask = null);

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
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
