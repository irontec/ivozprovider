<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

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
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get internationalCode
     *
     * @return string
     */
    public function getInternationalCode();

    /**
     * Get trunkPrefix
     *
     * @return string
     */
    public function getTrunkPrefix();

    /**
     * Set areaCode
     *
     * @param string $areaCode
     *
     * @return self
     */
    public function setAreaCode($areaCode = null);

    /**
     * Get areaCode
     *
     * @return string
     */
    public function getAreaCode();

    /**
     * Set nationalLen
     *
     * @param integer $nationalLen
     *
     * @return self
     */
    public function setNationalLen($nationalLen = null);

    /**
     * Get nationalLen
     *
     * @return integer
     */
    public function getNationalLen();

    /**
     * Set generateRules
     *
     * @param boolean $generateRules
     *
     * @return self
     */
    public function setGenerateRules($generateRules = null);

    /**
     * Get generateRules
     *
     * @return boolean
     */
    public function getGenerateRules();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null);

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\TransformationRuleSet\Name $name);

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
     * @return TransformationRuleSetTrait
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
     * @param \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface[] $rules
     * @return self
     */
    public function replaceRules(Collection $rules);

    /**
     * Get rules
     *
     * @return array
     */
    public function getRules(\Doctrine\Common\Collections\Criteria $criteria = null);

}

