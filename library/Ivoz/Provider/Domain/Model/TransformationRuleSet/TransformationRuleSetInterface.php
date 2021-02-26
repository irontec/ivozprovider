<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* TransformationRuleSetInterface
*/
interface TransformationRuleSetInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setInternationalCode(?string $internationalCode = null): static;

    /**
     * {@inheritDoc}
     */
    public function setTrunkPrefix(?string $trunkPrefix = null): static;

    public function getDescription(): ?string;

    public function getInternationalCode(): ?string;

    public function getTrunkPrefix(): ?string;

    public function getAreaCode(): ?string;

    public function getNationalLen(): ?int;

    public function getGenerateRules(): ?bool;

    public function getName(): Name;

    public function getBrand(): ?BrandInterface;

    public function getCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addRule(TransformationRuleInterface $rule): TransformationRuleSetInterface;

    public function removeRule(TransformationRuleInterface $rule): TransformationRuleSetInterface;

    public function replaceRules(ArrayCollection $rules): TransformationRuleSetInterface;

    public function getRules(?Criteria $criteria = null): array;

}
