<?php

namespace Ivoz\Provider\Domain\Model\BillableCallHistoric;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
* BillableCallHistoricInterface
*/
interface BillableCallHistoricInterface extends LoggableEntityInterface
{
    public const ENDPOINTTYPE_RETAILACCOUNT = 'RetailAccount';

    public const ENDPOINTTYPE_RESIDENTIALDEVICE = 'ResidentialDevice';

    public const ENDPOINTTYPE_USER = 'User';

    public const ENDPOINTTYPE_FRIEND = 'Friend';

    public const ENDPOINTTYPE_FAX = 'Fax';

    public const DIRECTION_INBOUND = 'inbound';

    public const DIRECTION_OUTBOUND = 'outbound';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): BillableCallHistoricDto;

    /**
     * @internal use EntityTools instead
     * @param null|BillableCallHistoricInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BillableCallHistoricDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BillableCallHistoricDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BillableCallHistoricDto;

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

    public function getNumRecordings(): int;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getDestination(): ?DestinationInterface;

    public function getRatingPlanGroup(): ?RatingPlanGroupInterface;

    public function getInvoice(): ?InvoiceInterface;

    public function getTrunksCdr(): ?TrunksCdrInterface;

    public function getDdi(): ?DdiInterface;

    public function getDdiProvider(): ?DdiProviderInterface;
}
