<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BillableCallInterface extends LoggableEntityInterface
{
    const ENDPOINTTYPE_RETAILACCOUNT = 'RetailAccount';
    const ENDPOINTTYPE_RESIDENTIALDEVICE = 'ResidentialDevice';
    const ENDPOINTTYPE_USER = 'User';
    const ENDPOINTTYPE_FRIEND = 'Friend';
    const ENDPOINTTYPE_FAX = 'Fax';


    const DIRECTION_INBOUND = 'inbound';
    const DIRECTION_OUTBOUND = 'outbound';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function isOutboundCall(): bool;

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
    public function getDuration(): float;

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
     * @return float | null
     */
    public function getCost();

    /**
     * Get price
     *
     * @return float | null
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
     * Get endpointName
     *
     * @return string | null
     */
    public function getEndpointName();

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface | null
     */
    public function getDestination();

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface | null
     */
    public function getRatingPlanGroup();

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface | null
     */
    public function getInvoice();

    /**
     * Get trunksCdr
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface | null
     */
    public function getTrunksCdr();

    /**
     * Get ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi();

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
