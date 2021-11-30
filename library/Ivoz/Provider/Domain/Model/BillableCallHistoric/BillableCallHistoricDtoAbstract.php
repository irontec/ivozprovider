<?php

namespace Ivoz\Provider\Domain\Model\BillableCallHistoric;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto;

/**
* BillableCallHistoricDtoAbstract
* @codeCoverageIgnore
*/
abstract class BillableCallHistoricDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $callid = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $startTime = null;

    /**
     * @var float|null
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $caller = null;

    /**
     * @var string|null
     */
    private $callee = null;

    /**
     * @var float|null
     */
    private $cost = null;

    /**
     * @var float|null
     */
    private $price = null;

    /**
     * @var array|null
     */
    private $priceDetails = null;

    /**
     * @var string|null
     */
    private $carrierName = null;

    /**
     * @var string|null
     */
    private $destinationName = null;

    /**
     * @var string|null
     */
    private $ratingPlanName = null;

    /**
     * @var string|null
     */
    private $endpointType = null;

    /**
     * @var int|null
     */
    private $endpointId = null;

    /**
     * @var string|null
     */
    private $endpointName = null;

    /**
     * @var string|null
     */
    private $direction = 'outbound';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var CarrierDto | null
     */
    private $carrier = null;

    /**
     * @var DestinationDto | null
     */
    private $destination = null;

    /**
     * @var RatingPlanGroupDto | null
     */
    private $ratingPlanGroup = null;

    /**
     * @var InvoiceDto | null
     */
    private $invoice = null;

    /**
     * @var TrunksCdrDto | null
     */
    private $trunksCdr = null;

    /**
     * @var DdiDto | null
     */
    private $ddi = null;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider = null;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'callid' => 'callid',
            'startTime' => 'startTime',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'cost' => 'cost',
            'price' => 'price',
            'priceDetails' => 'priceDetails',
            'carrierName' => 'carrierName',
            'destinationName' => 'destinationName',
            'ratingPlanName' => 'ratingPlanName',
            'endpointType' => 'endpointType',
            'endpointId' => 'endpointId',
            'endpointName' => 'endpointName',
            'direction' => 'direction',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'destinationId' => 'destination',
            'ratingPlanGroupId' => 'ratingPlanGroup',
            'invoiceId' => 'invoice',
            'trunksCdrId' => 'trunksCdr',
            'ddiId' => 'ddi',
            'ddiProviderId' => 'ddiProvider'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'callid' => $this->getCallid(),
            'startTime' => $this->getStartTime(),
            'duration' => $this->getDuration(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'cost' => $this->getCost(),
            'price' => $this->getPrice(),
            'priceDetails' => $this->getPriceDetails(),
            'carrierName' => $this->getCarrierName(),
            'destinationName' => $this->getDestinationName(),
            'ratingPlanName' => $this->getRatingPlanName(),
            'endpointType' => $this->getEndpointType(),
            'endpointId' => $this->getEndpointId(),
            'endpointName' => $this->getEndpointName(),
            'direction' => $this->getDirection(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'destination' => $this->getDestination(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'invoice' => $this->getInvoice(),
            'trunksCdr' => $this->getTrunksCdr(),
            'ddi' => $this->getDdi(),
            'ddiProvider' => $this->getDdiProvider()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setCallid(?string $callid): static
    {
        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    public function setStartTime(null|\DateTimeInterface|string $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getStartTime(): \DateTimeInterface|string|null
    {
        return $this->startTime;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setCaller(?string $caller): static
    {
        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    public function setCallee(?string $callee): static
    {
        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    public function setCost(?float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPriceDetails(?array $priceDetails): static
    {
        $this->priceDetails = $priceDetails;

        return $this;
    }

    public function getPriceDetails(): ?array
    {
        return $this->priceDetails;
    }

    public function setCarrierName(?string $carrierName): static
    {
        $this->carrierName = $carrierName;

        return $this;
    }

    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    public function setDestinationName(?string $destinationName): static
    {
        $this->destinationName = $destinationName;

        return $this;
    }

    public function getDestinationName(): ?string
    {
        return $this->destinationName;
    }

    public function setRatingPlanName(?string $ratingPlanName): static
    {
        $this->ratingPlanName = $ratingPlanName;

        return $this;
    }

    public function getRatingPlanName(): ?string
    {
        return $this->ratingPlanName;
    }

    public function setEndpointType(?string $endpointType): static
    {
        $this->endpointType = $endpointType;

        return $this;
    }

    public function getEndpointType(): ?string
    {
        return $this->endpointType;
    }

    public function setEndpointId(?int $endpointId): static
    {
        $this->endpointId = $endpointId;

        return $this;
    }

    public function getEndpointId(): ?int
    {
        return $this->endpointId;
    }

    public function setEndpointName(?string $endpointName): static
    {
        $this->endpointName = $endpointName;

        return $this;
    }

    public function getEndpointName(): ?string
    {
        return $this->endpointName;
    }

    public function setDirection(?string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDestination(?DestinationDto $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): ?DestinationDto
    {
        return $this->destination;
    }

    public function setDestinationId($id): static
    {
        $value = !is_null($id)
            ? new DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRatingPlanGroup(?RatingPlanGroupDto $ratingPlanGroup): static
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    public function getRatingPlanGroup(): ?RatingPlanGroupDto
    {
        return $this->ratingPlanGroup;
    }

    public function setRatingPlanGroupId($id): static
    {
        $value = !is_null($id)
            ? new RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    public function setInvoice(?InvoiceDto $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getInvoice(): ?InvoiceDto
    {
        return $this->invoice;
    }

    public function setInvoiceId($id): static
    {
        $value = !is_null($id)
            ? new InvoiceDto($id)
            : null;

        return $this->setInvoice($value);
    }

    public function getInvoiceId()
    {
        if ($dto = $this->getInvoice()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTrunksCdr(?TrunksCdrDto $trunksCdr): static
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    public function getTrunksCdr(): ?TrunksCdrDto
    {
        return $this->trunksCdr;
    }

    public function setTrunksCdrId($id): static
    {
        $value = !is_null($id)
            ? new TrunksCdrDto($id)
            : null;

        return $this->setTrunksCdr($value);
    }

    public function getTrunksCdrId()
    {
        if ($dto = $this->getTrunksCdr()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdi(?DdiDto $ddi): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiDto
    {
        return $this->ddi;
    }

    public function setDdiId($id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    public function getDdiId()
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdiProvider(?DdiProviderDto $ddiProvider): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    public function setDdiProviderId($id): static
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }
}
