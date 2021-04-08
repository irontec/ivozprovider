<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* RoutingTagInterface
*/
interface RoutingTagInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return string
     */
    public function getCgrSubject();

    public function getName(): string;

    public function getTag(): string;

    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface;

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingTagInterface;

    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    public function addRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface;

    public function removeRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface;

    public function replaceRelCompanies(ArrayCollection $relCompanies): RoutingTagInterface;

    public function getRelCompanies(?Criteria $criteria = null): array;
}
