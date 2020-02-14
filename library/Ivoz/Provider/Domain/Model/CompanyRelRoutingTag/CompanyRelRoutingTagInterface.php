<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

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
}
