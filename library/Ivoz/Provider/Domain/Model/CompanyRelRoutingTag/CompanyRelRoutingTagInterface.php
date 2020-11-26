<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CompanyRelRoutingTagInterface
*/
interface CompanyRelRoutingTagInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): CompanyRelRoutingTagInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Set routingTag
     *
     * @param RoutingTagInterface
     *
     * @return static
     */
    public function setRoutingTag(RoutingTagInterface $routingTag): CompanyRelRoutingTagInterface;

    /**
     * Get routingTag
     *
     * @return RoutingTagInterface
     */
    public function getRoutingTag(): RoutingTagInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
