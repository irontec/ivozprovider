<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* DdiProviderInterface
*/
interface DdiProviderInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get externallyRated
     *
     * @return bool | null
     */
    public function getExternallyRated(): ?bool;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * Get proxyTrunk
     *
     * @return ProxyTrunkInterface | null
     */
    public function getProxyTrunk(): ?ProxyTrunkInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add ddiProviderRegistration
     *
     * @param DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return static
     */
    public function addDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface;

    /**
     * Remove ddiProviderRegistration
     *
     * @param DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return static
     */
    public function removeDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface;

    /**
     * Replace ddiProviderRegistrations
     *
     * @param ArrayCollection $ddiProviderRegistrations of DdiProviderRegistrationInterface
     *
     * @return static
     */
    public function replaceDdiProviderRegistrations(ArrayCollection $ddiProviderRegistrations): DdiProviderInterface;

    /**
     * Get ddiProviderRegistrations
     * @param Criteria | null $criteria
     * @return DdiProviderRegistrationInterface[]
     */
    public function getDdiProviderRegistrations(?Criteria $criteria = null): array;

    /**
     * Add ddiProviderAddress
     *
     * @param DdiProviderAddressInterface $ddiProviderAddress
     *
     * @return static
     */
    public function addDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface;

    /**
     * Remove ddiProviderAddress
     *
     * @param DdiProviderAddressInterface $ddiProviderAddress
     *
     * @return static
     */
    public function removeDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface;

    /**
     * Replace ddiProviderAddresses
     *
     * @param ArrayCollection $ddiProviderAddresses of DdiProviderAddressInterface
     *
     * @return static
     */
    public function replaceDdiProviderAddresses(ArrayCollection $ddiProviderAddresses): DdiProviderInterface;

    /**
     * Get ddiProviderAddresses
     * @param Criteria | null $criteria
     * @return DdiProviderAddressInterface[]
     */
    public function getDdiProviderAddresses(?Criteria $criteria = null): array;

}
