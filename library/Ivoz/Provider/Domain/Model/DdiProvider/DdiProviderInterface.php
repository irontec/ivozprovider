<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function getDescription();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get externallyRated
     *
     * @return boolean | null
     */
    public function getExternallyRated();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet | null
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null);

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();

    /**
     * Add ddiProviderRegistration
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return static
     */
    public function addDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration);

    /**
     * Remove ddiProviderRegistration
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     */
    public function removeDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration);

    /**
     * Replace ddiProviderRegistrations
     *
     * @param ArrayCollection $ddiProviderRegistrations of Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface
     * @return static
     */
    public function replaceDdiProviderRegistrations(ArrayCollection $ddiProviderRegistrations);

    /**
     * Get ddiProviderRegistrations
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface[]
     */
    public function getDdiProviderRegistrations(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ddiProviderAddress
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress
     *
     * @return static
     */
    public function addDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress);

    /**
     * Remove ddiProviderAddress
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress
     */
    public function removeDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress);

    /**
     * Replace ddiProviderAddresses
     *
     * @param ArrayCollection $ddiProviderAddresses of Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface
     * @return static
     */
    public function replaceDdiProviderAddresses(ArrayCollection $ddiProviderAddresses);

    /**
     * Get ddiProviderAddresses
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface[]
     */
    public function getDdiProviderAddresses(\Doctrine\Common\Collections\Criteria $criteria = null);
}
