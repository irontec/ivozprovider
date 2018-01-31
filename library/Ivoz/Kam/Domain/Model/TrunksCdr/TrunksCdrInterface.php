<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TrunksCdrInterface extends EntityInterface
{
    /**
     * @return bool
     */
    public function isBounced();

    /**
     * @return string
     */
    public function getGhostPrice();

    /**
     * @return string
     */
    public function getGhostDuration();

    public function __toString();

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
     * Set bounced
     *
     * @param boolean $bounced
     *
     * @return self
     */
    public function setBounced($bounced = null);

    /**
     * Get bounced
     *
     * @return boolean
     */
    public function getBounced();

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
     * Set priceDetails
     *
     * @param string $priceDetails
     *
     * @return self
     */
    public function setPriceDetails($priceDetails = null);

    /**
     * Get priceDetails
     *
     * @return string
     */
    public function getPriceDetails();

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
     * Set cgrid
     *
     * @param string $cgrid
     *
     * @return self
     */
    public function setCgrid($cgrid = null);

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid();

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

    /**
     * Set destination
     *
     * @param \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination = null);

    /**
     * Get destination
     *
     * @return \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return self
     */
    public function setRatingPlan(\Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan = null);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan();

}

