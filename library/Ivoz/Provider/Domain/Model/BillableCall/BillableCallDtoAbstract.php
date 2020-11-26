<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

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
* BillableCallDtoAbstract
* @codeCoverageIgnore
*/
abstract class BillableCallDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $callid;

    /**
     * @var \DateTimeInterface | null
     */
    private $startTime;

    /**
     * @var float
     */
    private $duration = 0;

    /**
     * @var string | null
     */
    private $caller;

    /**
     * @var string | null
     */
    private $callee;

    /**
     * @var float | null
     */
    private $cost;

    /**
     * @var float | null
     */
    private $price;

    /**
     * @var array | null
     */
    private $priceDetails;

    /**
     * @var string | null
     */
    private $carrierName;

    /**
     * @var string | null
     */
    private $destinationName;

    /**
     * @var string | null
     */
    private $ratingPlanName;

    /**
     * @var string | null
     */
    private $endpointType;

    /**
     * @var int | null
     */
    private $endpointId;

    /**
     * @var string | null
     */
    private $endpointName;

    /**
     * @var string | null
     */
    private $direction = 'outbound';

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var DestinationDto | null
     */
    private $destination;

    /**
     * @var RatingPlanGroupDto | null
     */
    private $ratingPlanGroup;

    /**
     * @var InvoiceDto | null
     */
    private $invoice;

    /**
     * @var TrunksCdrDto | null
     */
    private $trunksCdr;

    /**
     * @var DdiDto | null
     */
    private $ddi;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $callid | null
     *
     * @return static
     */
    public function setCallid(?string $callid = null): self
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * @param \DateTimeInterface $startTime | null
     *
     * @return static
     */
    public function setStartTime($startTime = null): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param float $duration | null
     *
     * @return static
     */
    public function setDuration(?float $duration = null): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param string $caller | null
     *
     * @return static
     */
    public function setCaller(?string $caller = null): self
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCaller(): ?string
    {
        return $this->caller;
    }

    /**
     * @param string $callee | null
     *
     * @return static
     */
    public function setCallee(?string $callee = null): self
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallee(): ?string
    {
        return $this->callee;
    }

    /**
     * @param float $cost | null
     *
     * @return static
     */
    public function setCost(?float $cost = null): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @param float $price | null
     *
     * @return static
     */
    public function setPrice(?float $price = null): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param array $priceDetails | null
     *
     * @return static
     */
    public function setPriceDetails(?array $priceDetails = null): self
    {
        $this->priceDetails = $priceDetails;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getPriceDetails(): ?array
    {
        return $this->priceDetails;
    }

    /**
     * @param string $carrierName | null
     *
     * @return static
     */
    public function setCarrierName(?string $carrierName = null): self
    {
        $this->carrierName = $carrierName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    /**
     * @param string $destinationName | null
     *
     * @return static
     */
    public function setDestinationName(?string $destinationName = null): self
    {
        $this->destinationName = $destinationName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationName(): ?string
    {
        return $this->destinationName;
    }

    /**
     * @param string $ratingPlanName | null
     *
     * @return static
     */
    public function setRatingPlanName(?string $ratingPlanName = null): self
    {
        $this->ratingPlanName = $ratingPlanName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatingPlanName(): ?string
    {
        return $this->ratingPlanName;
    }

    /**
     * @param string $endpointType | null
     *
     * @return static
     */
    public function setEndpointType(?string $endpointType = null): self
    {
        $this->endpointType = $endpointType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEndpointType(): ?string
    {
        return $this->endpointType;
    }

    /**
     * @param int $endpointId | null
     *
     * @return static
     */
    public function setEndpointId(?int $endpointId = null): self
    {
        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getEndpointId(): ?int
    {
        return $this->endpointId;
    }

    /**
     * @param string $endpointName | null
     *
     * @return static
     */
    public function setEndpointName(?string $endpointName = null): self
    {
        $this->endpointName = $endpointName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEndpointName(): ?string
    {
        return $this->endpointName;
    }

    /**
     * @param string $direction | null
     *
     * @return static
     */
    public function setDirection(?string $direction = null): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DestinationDto | null
     *
     * @return static
     */
    public function setDestination(?DestinationDto $destination = null): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return DestinationDto | null
     */
    public function getDestination(): ?DestinationDto
    {
        return $this->destination;
    }

    /**
     * @return static
     */
    public function setDestinationId($id): self
    {
        $value = !is_null($id)
            ? new DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    /**
     * @return mixed | null
     */
    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RatingPlanGroupDto | null
     *
     * @return static
     */
    public function setRatingPlanGroup(?RatingPlanGroupDto $ratingPlanGroup = null): self
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return RatingPlanGroupDto | null
     */
    public function getRatingPlanGroup(): ?RatingPlanGroupDto
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @return static
     */
    public function setRatingPlanGroupId($id): self
    {
        $value = !is_null($id)
            ? new RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param InvoiceDto | null
     *
     * @return static
     */
    public function setInvoice(?InvoiceDto $invoice = null): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * @return InvoiceDto | null
     */
    public function getInvoice(): ?InvoiceDto
    {
        return $this->invoice;
    }

    /**
     * @return static
     */
    public function setInvoiceId($id): self
    {
        $value = !is_null($id)
            ? new InvoiceDto($id)
            : null;

        return $this->setInvoice($value);
    }

    /**
     * @return mixed | null
     */
    public function getInvoiceId()
    {
        if ($dto = $this->getInvoice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TrunksCdrDto | null
     *
     * @return static
     */
    public function setTrunksCdr(?TrunksCdrDto $trunksCdr = null): self
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    /**
     * @return TrunksCdrDto | null
     */
    public function getTrunksCdr(): ?TrunksCdrDto
    {
        return $this->trunksCdr;
    }

    /**
     * @return static
     */
    public function setTrunksCdrId($id): self
    {
        $value = !is_null($id)
            ? new TrunksCdrDto($id)
            : null;

        return $this->setTrunksCdr($value);
    }

    /**
     * @return mixed | null
     */
    public function getTrunksCdrId()
    {
        if ($dto = $this->getTrunksCdr()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiDto | null
     *
     * @return static
     */
    public function setDdi(?DdiDto $ddi = null): self
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getDdi(): ?DdiDto
    {
        return $this->ddi;
    }

    /**
     * @return static
     */
    public function setDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiId()
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiProviderDto | null
     *
     * @return static
     */
    public function setDdiProvider(?DdiProviderDto $ddiProvider = null): self
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return DdiProviderDto | null
     */
    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    /**
     * @return static
     */
    public function setDdiProviderId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

}
