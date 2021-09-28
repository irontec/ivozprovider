<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CompanyRelRoutingTagInterface extends LoggableEntityInterface
{
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag);

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    public function getRoutingTag();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
