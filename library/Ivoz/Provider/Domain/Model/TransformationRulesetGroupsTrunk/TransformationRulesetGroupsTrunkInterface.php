<?php

namespace Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TransformationRulesetGroupsTrunkInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set callerIn
     *
     * @param integer $callerIn
     *
     * @return self
     */
    public function setCallerIn($callerIn = null);

    /**
     * Get callerIn
     *
     * @return integer
     */
    public function getCallerIn();

    /**
     * Set calleeIn
     *
     * @param integer $calleeIn
     *
     * @return self
     */
    public function setCalleeIn($calleeIn = null);

    /**
     * Get calleeIn
     *
     * @return integer
     */
    public function getCalleeIn();

    /**
     * Set callerOut
     *
     * @param integer $callerOut
     *
     * @return self
     */
    public function setCallerOut($callerOut = null);

    /**
     * Get callerOut
     *
     * @return integer
     */
    public function getCallerOut();

    /**
     * Set calleeOut
     *
     * @param integer $calleeOut
     *
     * @return self
     */
    public function setCalleeOut($calleeOut = null);

    /**
     * Get calleeOut
     *
     * @return integer
     */
    public function getCalleeOut();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set automatic
     *
     * @param boolean $automatic
     *
     * @return self
     */
    public function setAutomatic($automatic);

    /**
     * Get automatic
     *
     * @return boolean
     */
    public function getAutomatic();

    /**
     * Set internationalCode
     *
     * @param string $internationalCode
     *
     * @return self
     */
    public function setInternationalCode($internationalCode = null);

    /**
     * Get internationalCode
     *
     * @return string
     */
    public function getInternationalCode();

    /**
     * Set nationalNumLength
     *
     * @param integer $nationalNumLength
     *
     * @return self
     */
    public function setNationalNumLength($nationalNumLength = null);

    /**
     * Get nationalNumLength
     *
     * @return integer
     */
    public function getNationalNumLength();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

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

}

