<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function setInternationalCode($internationalCode = null);

    /**
     * {@inheritDoc}
     */
    public function setTrunkPrefix($trunkPrefix = null);

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Get internationalCode
     *
     * @return string | null
     */
    public function getInternationalCode();

    /**
     * Get trunkPrefix
     *
     * @return string | null
     */
    public function getTrunkPrefix();

    /**
     * Get areaCode
     *
     * @return string | null
     */
    public function getAreaCode();

    /**
     * Get nationalLen
     *
     * @return integer | null
     */
    public function getNationalLen();

    /**
     * Get generateRules
     *
     * @return boolean | null
     */
    public function getGenerateRules();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getCountry();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\Name
     */
    public function getName();

    /**
     * Add rule
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule
     *
     * @return static
     */
    public function addRule(\Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule);

    /**
     * Remove rule
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule
     */
    public function removeRule(\Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule);

    /**
     * Replace rules
     *
     * @param ArrayCollection $rules of Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface
     * @return static
     */
    public function replaceRules(ArrayCollection $rules);

    /**
     * Get rules
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface[]
     */
    public function getRules(\Doctrine\Common\Collections\Criteria $criteria = null);
}
