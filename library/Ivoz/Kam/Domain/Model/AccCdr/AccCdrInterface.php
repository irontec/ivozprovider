<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface AccCdrInterface extends EntityInterface
{
    /**
     * @todo move this to its own service
     */
    public function tarificate($plan = null);

    /**
     * @return bool
     */
    public function isBounced();

    /**
     * @param array $data
     * @return AccCdrInterface
     */
    public function setPricingPlanDetailsFromArray(array $data);

    /**
     * Set proxy
     *
     * @param string $proxy
     *
     * @return self
     */
    public function setProxy($proxy = null);

    /**
     * Get proxy
     *
     * @return string
     */
    public function getProxy();

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return self
     */
    public function setStartTime($startTime);

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime();

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return self
     */
    public function setEndTime($endTime);

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime();

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return self
     */
    public function setDuration($duration);

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration();

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
     * Set asiden
     *
     * @param string $asiden
     *
     * @return self
     */
    public function setAsiden($asiden = null);

    /**
     * Get asiden
     *
     * @return string
     */
    public function getAsiden();

    /**
     * Set asaddress
     *
     * @param string $asaddress
     *
     * @return self
     */
    public function setAsaddress($asaddress = null);

    /**
     * Get asaddress
     *
     * @return string
     */
    public function getAsaddress();

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid = null);

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid();

    /**
     * Set callidHash
     *
     * @param string $callidHash
     *
     * @return self
     */
    public function setCallidHash($callidHash = null);

    /**
     * Get callidHash
     *
     * @return string
     */
    public function getCallidHash();

    /**
     * Set xcallid
     *
     * @param string $xcallid
     *
     * @return self
     */
    public function setXcallid($xcallid = null);

    /**
     * Get xcallid
     *
     * @return string
     */
    public function getXcallid();

    /**
     * Set parsed
     *
     * @param string $parsed
     *
     * @return self
     */
    public function setParsed($parsed = null);

    /**
     * Get parsed
     *
     * @return string
     */
    public function getParsed();

    /**
     * Set diversion
     *
     * @param string $diversion
     *
     * @return self
     */
    public function setDiversion($diversion = null);

    /**
     * Get diversion
     *
     * @return string
     */
    public function getDiversion();

    /**
     * Set peeringContractId
     *
     * @param string $peeringContractId
     *
     * @return self
     */
    public function setPeeringContractId($peeringContractId = null);

    /**
     * Get peeringContractId
     *
     * @return string
     */
    public function getPeeringContractId();

    /**
     * Set bounced
     *
     * @param string $bounced
     *
     * @return self
     */
    public function setBounced($bounced);

    /**
     * Get bounced
     *
     * @return string
     */
    public function getBounced();

    /**
     * Set externallyRated
     *
     * @param boolean $externallyRated
     *
     * @return self
     */
    public function setExternallyRated($externallyRated = null);

    /**
     * Get externallyRated
     *
     * @return boolean
     */
    public function getExternallyRated();

    /**
     * Set metered
     *
     * @param boolean $metered
     *
     * @return self
     */
    public function setMetered($metered = null);

    /**
     * Get metered
     *
     * @return boolean
     */
    public function getMetered();

    /**
     * Set meteringDate
     *
     * @param \DateTime $meteringDate
     *
     * @return self
     */
    public function setMeteringDate($meteringDate = null);

    /**
     * Get meteringDate
     *
     * @return \DateTime
     */
    public function getMeteringDate();

    /**
     * Set pricingPlanName
     *
     * @param string $pricingPlanName
     *
     * @return self
     */
    public function setPricingPlanName($pricingPlanName = null);

    /**
     * Get pricingPlanName
     *
     * @return string
     */
    public function getPricingPlanName();

    /**
     * Set targetPatternName
     *
     * @param string $targetPatternName
     *
     * @return self
     */
    public function setTargetPatternName($targetPatternName = null);

    /**
     * Get targetPatternName
     *
     * @return string
     */
    public function getTargetPatternName();

    /**
     * Set price
     *
     * @param string $price
     *
     * @return self
     */
    public function setPrice($price = null);

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice();

    /**
     * Set pricingPlanDetails
     *
     * @param string $pricingPlanDetails
     *
     * @return self
     */
    public function setPricingPlanDetails($pricingPlanDetails = null);

    /**
     * Get pricingPlanDetails
     *
     * @return string
     */
    public function getPricingPlanDetails();

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    public function setDirection($direction = null);

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection();

    /**
     * Set reMeteringDate
     *
     * @param \DateTime $reMeteringDate
     *
     * @return self
     */
    public function setReMeteringDate($reMeteringDate = null);

    /**
     * Get reMeteringDate
     *
     * @return \DateTime
     */
    public function getReMeteringDate();

    /**
     * Set pricingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan
     *
     * @return self
     */
    public function setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan = null);

    /**
     * Get pricingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    public function getPricingPlan();

    /**
     * Set targetPattern
     *
     * @param \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern
     *
     * @return self
     */
    public function setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern = null);

    /**
     * Get targetPattern
     *
     * @return \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface
     */
    public function getTargetPattern();

    /**
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice
     *
     * @return self
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice = null);

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface
     */
    public function getInvoice();

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

}

