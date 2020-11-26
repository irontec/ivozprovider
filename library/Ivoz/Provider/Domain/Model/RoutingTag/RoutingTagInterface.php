<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag(): string;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface;

    /**
     * Remove outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface;

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of OutgoingRoutingInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingTagInterface;

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    /**
     * Add relCompany
     *
     * @param CompanyRelRoutingTagInterface $relCompany
     *
     * @return static
     */
    public function addRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface;

    /**
     * Remove relCompany
     *
     * @param CompanyRelRoutingTagInterface $relCompany
     *
     * @return static
     */
    public function removeRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface;

    /**
     * Replace relCompanies
     *
     * @param ArrayCollection $relCompanies of CompanyRelRoutingTagInterface
     *
     * @return static
     */
    public function replaceRelCompanies(ArrayCollection $relCompanies): RoutingTagInterface;

    /**
     * Get relCompanies
     * @param Criteria | null $criteria
     * @return CompanyRelRoutingTagInterface[]
     */
    public function getRelCompanies(?Criteria $criteria = null): array;

}
