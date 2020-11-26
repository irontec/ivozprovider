<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* TrustedInterface
*/
interface TrustedInterface extends EntityInterface
{

    public function setSrcIp(string $srcIp = null): TrustedInterface;

    /**
     * Get srcIp
     *
     * @return string | null
     */
    public function getSrcIp(): ?string;

    /**
     * Get proto
     *
     * @return string | null
     */
    public function getProto(): ?string;

    /**
     * Get fromPattern
     *
     * @return string | null
     */
    public function getFromPattern(): ?string;

    /**
     * Get ruriPattern
     *
     * @return string | null
     */
    public function getRuriPattern(): ?string;

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
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

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
