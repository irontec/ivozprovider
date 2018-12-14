<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BillableCallInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid();

    /**
     * Get startTime
     *
     * @return \DateTime | null
     */
    public function getStartTime();

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration();

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller();

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee();

    /**
     * Get cost
     *
     * @return string | null
     */
    public function getCost();

    /**
     * Get price
     *
     * @return string | null
     */
    public function getPrice();

    /**
     * Get priceDetails
     *
     * @return array | null
     */
    public function getPriceDetails();

    /**
     * Get carrierName
     *
     * @return string | null
     */
    public function getCarrierName();

    /**
     * Get destinationName
     *
     * @return string | null
     */
    public function getDestinationName();

    /**
     * Get ratingPlanName
     *
     * @return string | null
     */
    public function getRatingPlanName();

    /**
     * Get endpointType
     *
     * @return string | null
     */
    public function getEndpointType();

    /**
     * Get endpointId
     *
     * @return integer | null
     */
    public function getEndpointId();

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Set destination
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination = null);

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface | null
     */
    public function getDestination();

    /**
     * Set ratingPlanGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup
     *
     * @return self
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup = null);

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface | null
     */
    public function getRatingPlanGroup();

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
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface | null
     */
    public function getInvoice();

    /**
     * Set trunksCdr
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface $trunksCdr
     *
     * @return self
     */
    public function setTrunksCdr(\Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface $trunksCdr = null);

    /**
     * Get trunksCdr
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface | null
     */
    public function getTrunksCdr();
}
