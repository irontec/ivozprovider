<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setInternationalCode(string $internationalCode = null): TransformationRuleSetInterface;

    /**
     * {@inheritDoc}
     */
    public function setTrunkPrefix(string $trunkPrefix = null): TransformationRuleSetInterface;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Get internationalCode
     *
     * @return string | null
     */
    public function getInternationalCode(): ?string;

    /**
     * Get trunkPrefix
     *
     * @return string | null
     */
    public function getTrunkPrefix(): ?string;

    /**
     * Get areaCode
     *
     * @return string | null
     */
    public function getAreaCode(): ?string;

    /**
     * Get nationalLen
     *
     * @return int | null
     */
    public function getNationalLen(): ?int;

    /**
     * Get generateRules
     *
     * @return bool | null
     */
    public function getGenerateRules(): ?bool;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get country
     *
     * @return CountryInterface | null
     */
    public function getCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add rule
     *
     * @param TransformationRuleInterface $rule
     *
     * @return static
     */
    public function addRule(TransformationRuleInterface $rule): TransformationRuleSetInterface;

    /**
     * Remove rule
     *
     * @param TransformationRuleInterface $rule
     *
     * @return static
     */
    public function removeRule(TransformationRuleInterface $rule): TransformationRuleSetInterface;

    /**
     * Replace rules
     *
     * @param ArrayCollection $rules of TransformationRuleInterface
     *
     * @return static
     */
    public function replaceRules(ArrayCollection $rules): TransformationRuleSetInterface;

    /**
     * Get rules
     * @param Criteria | null $criteria
     * @return TransformationRuleInterface[]
     */
    public function getRules(?Criteria $criteria = null): array;

}
