<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;

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

    public function getCallid(): ?string;

    public function getStartTime(): ?\DateTime;

    public function getDuration(): float;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getCost(): ?float;

    public function getPrice(): ?float;

    public function getPriceDetails(): ?array;

    public function getCarrierName(): ?string;

    public function getDestinationName(): ?string;

    public function getRatingPlanName(): ?string;

    public function getEndpointType(): ?string;

    public function getEndpointId(): ?int;

    public function getEndpointName(): ?string;

    public function getDirection(): ?string;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getDestination(): ?DestinationInterface;

    public function getRatingPlanGroup(): ?RatingPlanGroupInterface;

    public function getInvoice(): ?InvoiceInterface;

    public function getTrunksCdr(): ?TrunksCdrInterface;

    public function getDdi(): ?DdiInterface;

    public function getDdiProvider(): ?DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
