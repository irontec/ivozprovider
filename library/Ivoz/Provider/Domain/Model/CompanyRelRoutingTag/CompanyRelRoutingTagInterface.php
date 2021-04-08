<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;

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

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function setRoutingTag(RoutingTagInterface $routingTag): static;

    public function getRoutingTag(): RoutingTagInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
