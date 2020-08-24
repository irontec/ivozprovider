<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TrustedInterface extends EntityInterface
{
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
    public function getPriority(): int;

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
