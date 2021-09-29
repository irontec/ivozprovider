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

    public function setCompany(?CompanyInterface $company = null): static;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getCompany(): ?CompanyInterface;

    public function setRoutingTag(RoutingTagInterface $routingTag): static;

    public function getRoutingTag(): RoutingTagInterface;

    public function isInitialized(): bool;
}
