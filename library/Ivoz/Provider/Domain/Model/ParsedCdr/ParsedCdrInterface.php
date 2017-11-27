<?php

namespace Ivoz\Provider\Domain\Model\ParsedCdr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ParsedCdrInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set statId
     *
     * @param integer $statId
     *
     * @return self
     */
    public function setStatId($statId = null);

    /**
     * Get statId
     *
     * @return integer
     */
    public function getStatId();

    /**
     * Set xstatId
     *
     * @param integer $xstatId
     *
     * @return self
     */
    public function setXstatId($xstatId = null);

    /**
     * Get xstatId
     *
     * @return integer
     */
    public function getXstatId();

    /**
     * Set statType
     *
     * @param string $statType
     *
     * @return self
     */
    public function setStatType($statType = null);

    /**
     * Get statType
     *
     * @return string
     */
    public function getStatType();

    /**
     * Set initialLeg
     *
     * @param string $initialLeg
     *
     * @return self
     */
    public function setInitialLeg($initialLeg = null);

    /**
     * Get initialLeg
     *
     * @return string
     */
    public function getInitialLeg();

    /**
     * Set initialLegHash
     *
     * @param string $initialLegHash
     *
     * @return self
     */
    public function setInitialLegHash($initialLegHash = null);

    /**
     * Get initialLegHash
     *
     * @return string
     */
    public function getInitialLegHash();

    /**
     * Set cid
     *
     * @param string $cid
     *
     * @return self
     */
    public function setCid($cid = null);

    /**
     * Get cid
     *
     * @return string
     */
    public function getCid();

    /**
     * Set cidHash
     *
     * @param string $cidHash
     *
     * @return self
     */
    public function setCidHash($cidHash = null);

    /**
     * Get cidHash
     *
     * @return string
     */
    public function getCidHash();

    /**
     * Set xcid
     *
     * @param string $xcid
     *
     * @return self
     */
    public function setXcid($xcid = null);

    /**
     * Get xcid
     *
     * @return string
     */
    public function getXcid();

    /**
     * Set xcidHash
     *
     * @param string $xcidHash
     *
     * @return self
     */
    public function setXcidHash($xcidHash = null);

    /**
     * Get xcidHash
     *
     * @return string
     */
    public function getXcidHash();

    /**
     * Set proxies
     *
     * @param string $proxies
     *
     * @return self
     */
    public function setProxies($proxies = null);

    /**
     * Get proxies
     *
     * @return string
     */
    public function getProxies();

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set subtype
     *
     * @param string $subtype
     *
     * @return self
     */
    public function setSubtype($subtype = null);

    /**
     * Get subtype
     *
     * @return string
     */
    public function getSubtype();

    /**
     * Set calldate
     *
     * @param \DateTime $calldate
     *
     * @return self
     */
    public function setCalldate($calldate);

    /**
     * Get calldate
     *
     * @return \DateTime
     */
    public function getCalldate();

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return self
     */
    public function setDuration($duration = null);

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration();

    /**
     * Set aParty
     *
     * @param string $aParty
     *
     * @return self
     */
    public function setAParty($aParty = null);

    /**
     * Get aParty
     *
     * @return string
     */
    public function getAParty();

    /**
     * Set bParty
     *
     * @param string $bParty
     *
     * @return self
     */
    public function setBParty($bParty = null);

    /**
     * Get bParty
     *
     * @return string
     */
    public function getBParty();

    /**
     * Set caller
     *
     * @param string $caller
     *
     * @return self
     */
    public function setCaller($caller = null);

    /**
     * Get caller
     *
     * @return string
     */
    public function getCaller();

    /**
     * Set callee
     *
     * @param string $callee
     *
     * @return self
     */
    public function setCallee($callee = null);

    /**
     * Get callee
     *
     * @return string
     */
    public function getCallee();

    /**
     * Set xCaller
     *
     * @param string $xCaller
     *
     * @return self
     */
    public function setXCaller($xCaller = null);

    /**
     * Get xCaller
     *
     * @return string
     */
    public function getXCaller();

    /**
     * Set xCallee
     *
     * @param string $xCallee
     *
     * @return self
     */
    public function setXCallee($xCallee = null);

    /**
     * Get xCallee
     *
     * @return string
     */
    public function getXCallee();

    /**
     * Set initialReferrer
     *
     * @param string $initialReferrer
     *
     * @return self
     */
    public function setInitialReferrer($initialReferrer = null);

    /**
     * Get initialReferrer
     *
     * @return string
     */
    public function getInitialReferrer();

    /**
     * Set referrer
     *
     * @param string $referrer
     *
     * @return self
     */
    public function setReferrer($referrer = null);

    /**
     * Get referrer
     *
     * @return string
     */
    public function getReferrer();

    /**
     * Set referee
     *
     * @param string $referee
     *
     * @return self
     */
    public function setReferee($referee = null);

    /**
     * Get referee
     *
     * @return string
     */
    public function getReferee();

    /**
     * Set lastForwarder
     *
     * @param string $lastForwarder
     *
     * @return self
     */
    public function setLastForwarder($lastForwarder = null);

    /**
     * Get lastForwarder
     *
     * @return string
     */
    public function getLastForwarder();

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract = null);

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract();

}

