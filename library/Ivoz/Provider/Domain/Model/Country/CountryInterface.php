<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Domain\Model\EntityInterface;

interface CountryInterface extends EntityInterface
{
    /**
     * Convert a dialed number to E164 form
     *
     * @param string $number
     * @return string number in E164
     */
    public function preferredToE164($number, $areaCode = null);

    /**
     * Convert a received number to Company prefered format
     *
     * @param string $e164number
     * @param string $areaCode
     * @return string
     */
    public function E164ToPreferred($e164number, $areaCode = null);

    /**
     * Check if a country uses Area code
     *
     * return true if the country has area code in its e164 pattern
     */
    public function hasAreaCode();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set callingCode
     *
     * @param integer $callingCode
     *
     * @return self
     */
    public function setCallingCode($callingCode = null);

    /**
     * Get callingCode
     *
     * @return integer
     */
    public function getCallingCode();

    /**
     * Set intCode
     *
     * @param string $intCode
     *
     * @return self
     */
    public function setIntCode($intCode = null);

    /**
     * Get intCode
     *
     * @return string
     */
    public function getIntCode();

    /**
     * Set e164Pattern
     *
     * @param string $e164Pattern
     *
     * @return self
     */
    public function setE164Pattern($e164Pattern = null);

    /**
     * Get e164Pattern
     *
     * @return string
     */
    public function getE164Pattern();

    /**
     * Set nationalCC
     *
     * @param boolean $nationalCC
     *
     * @return self
     */
    public function setNationalCC($nationalCC);

    /**
     * Get nationalCC
     *
     * @return boolean
     */
    public function getNationalCC();

    /**
     * Set name
     *
     * @param Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\Country\Name $name);

    /**
     * Get name
     *
     * @return Name
     */
    public function getName();

    /**
     * Set zone
     *
     * @param Zone $zone
     *
     * @return self
     */
    public function setZone(\Ivoz\Provider\Domain\Model\Country\Zone $zone);

    /**
     * Get zone
     *
     * @return Zone
     */
    public function getZone();

}

