<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* BillableCallInterface
*/
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
    public function getCallid(): ?string;

    /**
     * Get startTime
     *
     * @return \DateTimeInterface | null
     */
    public function getStartTime(): ?\DateTimeInterface;

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
    public function getCaller(): ?string;

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee(): ?string;

    /**
     * Get cost
     *
     * @return float | null
     */
    public function getCost(): ?float;

    /**
     * Get price
     *
     * @return float | null
     */
    public function getPrice(): ?float;

    /**
     * Get priceDetails
     *
     * @return array | null
     */
    public function getPriceDetails(): ?array;

    /**
     * Get carrierName
     *
     * @return string | null
     */
    public function getCarrierName(): ?string;

    /**
     * Get destinationName
     *
     * @return string | null
     */
    public function getDestinationName(): ?string;

    /**
     * Get ratingPlanName
     *
     * @return string | null
     */
    public function getRatingPlanName(): ?string;

    /**
     * Get endpointType
     *
     * @return string | null
     */
    public function getEndpointType(): ?string;

    /**
     * Get endpointId
     *
     * @return int | null
     */
    public function getEndpointId(): ?int;

    /**
     * Get endpointName
     *
     * @return string | null
     */
    public function getEndpointName(): ?string;

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection(): ?string;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface;

    /**
     * Get destination
     *
     * @return DestinationInterface | null
     */
    public function getDestination(): ?DestinationInterface;

    /**
     * Get ratingPlanGroup
     *
     * @return RatingPlanGroupInterface | null
     */
    public function getRatingPlanGroup(): ?RatingPlanGroupInterface;

    /**
     * Get invoice
     *
     * @return InvoiceInterface | null
     */
    public function getInvoice(): ?InvoiceInterface;

    /**
     * Get trunksCdr
     *
     * @return TrunksCdrInterface | null
     */
    public function getTrunksCdr(): ?TrunksCdrInterface;

    /**
     * Get ddi
     *
     * @return DdiInterface | null
     */
    public function getDdi(): ?DdiInterface;

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
