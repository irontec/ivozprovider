<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

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

    public function getDescription(): string;

    public function getName(): string;

    public function getExternallyRated(): ?bool;

    public function getBrand(): BrandInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getProxyTrunk(): ?ProxyTrunkInterface;

    public function isInitialized(): bool;

    public function addDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface;

    public function removeDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface;

    public function replaceDdiProviderRegistrations(ArrayCollection $ddiProviderRegistrations): DdiProviderInterface;

    public function getDdiProviderRegistrations(?Criteria $criteria = null): array;

    public function addDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface;

    public function removeDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface;

    public function replaceDdiProviderAddresses(ArrayCollection $ddiProviderAddresses): DdiProviderInterface;

    public function getDdiProviderAddresses(?Criteria $criteria = null): array;
}
