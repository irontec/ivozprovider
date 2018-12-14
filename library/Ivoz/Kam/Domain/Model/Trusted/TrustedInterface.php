<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TrustedInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setSrcIp($srcIp = null);

    /**
     * Get srcIp
     *
     * @return string | null
     */
    public function getSrcIp();

    /**
     * Get proto
     *
     * @return string | null
     */
    public function getProto();

    /**
     * Get fromPattern
     *
     * @return string | null
     */
    public function getFromPattern();

    /**
     * Get ruriPattern
     *
     * @return string | null
     */
    public function getRuriPattern();

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
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();
}
