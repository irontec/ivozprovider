<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersAddressInterface extends EntityInterface
{
    /**
     * Set sourceAddress
     *
     * @param string $sourceAddress
     *
     * @return self
     */
    public function setSourceAddress($sourceAddress);

    /**
     * Get sourceAddress
     *
     * @return string
     */
    public function getSourceAddress();

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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

}

