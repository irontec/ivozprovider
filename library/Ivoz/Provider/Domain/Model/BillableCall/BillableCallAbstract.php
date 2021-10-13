<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Destination\Destination;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

/**
* BillableCallAbstract
* @codeCoverageIgnore
*/
abstract class BillableCallAbstract
{
    use ChangelogTrait;

    protected $callid;

    protected $startTime;

    protected $duration = 0;

    protected $caller;

    protected $callee;

    protected $cost;

    protected $price;

    protected $priceDetails = [];

    protected $carrierName;

    protected $destinationName;

    protected $ratingPlanName;

    /**
     * comment: enum:RetailAccount|ResidentialDevice|User|Friend|Fax
     */
    protected $endpointType;

    protected $endpointId;

    protected $endpointName;

    /**
     * comment: enum:inbound|outbound
     */
    protected $direction = 'outbound';

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

    /**
     * @var CarrierInterface | null
     */
    protected $carrier;

    /**
     * @var DestinationInterface | null
     */
    protected $destination;

    /**
     * @var RatingPlanGroupInterface | null
     */
    protected $ratingPlanGroup;

    /**
     * @var InvoiceInterface | null
     */
    protected $invoice;

    /**
     * @var TrunksCdrInterface | null
     */
    protected $trunksCdr;

    /**
     * @var DdiInterface | null
     */
    protected $ddi;

    /**
     * @var DdiProviderInterface | null
     */
    protected $ddiProvider;

    /**
     * Constructor
     */
    protected function __construct(
        float $duration
    ) {
        $this->setDuration($duration);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "BillableCall",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     */
    public static function createDto($id = null): BillableCallDto
    {
        return new BillableCallDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BillableCallInterface|null $entity
     * @param int $depth
     * @return BillableCallDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BillableCallInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var BillableCallDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BillableCallDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BillableCallDto::class);

        $self = new static(
            $dto->getDuration()
        );

        $self
            ->setCallid($dto->getCallid())
            ->setStartTime($dto->getStartTime())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setCost($dto->getCost())
            ->setPrice($dto->getPrice())
            ->setPriceDetails($dto->getPriceDetails())
            ->setCarrierName($dto->getCarrierName())
            ->setDestinationName($dto->getDestinationName())
            ->setRatingPlanName($dto->getRatingPlanName())
            ->setEndpointType($dto->getEndpointType())
            ->setEndpointId($dto->getEndpointId())
            ->setEndpointName($dto->getEndpointName())
            ->setDirection($dto->getDirection())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setDestination($fkTransformer->transform($dto->getDestination()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setInvoice($fkTransformer->transform($dto->getInvoice()))
            ->setTrunksCdr($fkTransformer->transform($dto->getTrunksCdr()))
            ->setDdi($fkTransformer->transform($dto->getDdi()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BillableCallDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BillableCallDto::class);

        $this
            ->setCallid($dto->getCallid())
            ->setStartTime($dto->getStartTime())
            ->setDuration($dto->getDuration())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setCost($dto->getCost())
            ->setPrice($dto->getPrice())
            ->setPriceDetails($dto->getPriceDetails())
            ->setCarrierName($dto->getCarrierName())
            ->setDestinationName($dto->getDestinationName())
            ->setRatingPlanName($dto->getRatingPlanName())
            ->setEndpointType($dto->getEndpointType())
            ->setEndpointId($dto->getEndpointId())
            ->setEndpointName($dto->getEndpointName())
            ->setDirection($dto->getDirection())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setDestination($fkTransformer->transform($dto->getDestination()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setInvoice($fkTransformer->transform($dto->getInvoice()))
            ->setTrunksCdr($fkTransformer->transform($dto->getTrunksCdr()))
            ->setDdi($fkTransformer->transform($dto->getDdi()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): BillableCallDto
    {
        return self::createDto()
            ->setCallid(self::getCallid())
            ->setStartTime(self::getStartTime())
            ->setDuration(self::getDuration())
            ->setCaller(self::getCaller())
            ->setCallee(self::getCallee())
            ->setCost(self::getCost())
            ->setPrice(self::getPrice())
            ->setPriceDetails(self::getPriceDetails())
            ->setCarrierName(self::getCarrierName())
            ->setDestinationName(self::getDestinationName())
            ->setRatingPlanName(self::getRatingPlanName())
            ->setEndpointType(self::getEndpointType())
            ->setEndpointId(self::getEndpointId())
            ->setEndpointName(self::getEndpointName())
            ->setDirection(self::getDirection())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setDestination(Destination::entityToDto(self::getDestination(), $depth))
            ->setRatingPlanGroup(RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setInvoice(Invoice::entityToDto(self::getInvoice(), $depth))
            ->setTrunksCdr(TrunksCdr::entityToDto(self::getTrunksCdr(), $depth))
            ->setDdi(Ddi::entityToDto(self::getDdi(), $depth))
            ->setDdiProvider(DdiProvider::entityToDto(self::getDdiProvider(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'callid' => self::getCallid(),
            'startTime' => self::getStartTime(),
            'duration' => self::getDuration(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'cost' => self::getCost(),
            'price' => self::getPrice(),
            'priceDetails' => self::getPriceDetails(),
            'carrierName' => self::getCarrierName(),
            'destinationName' => self::getDestinationName(),
            'ratingPlanName' => self::getRatingPlanName(),
            'endpointType' => self::getEndpointType(),
            'endpointId' => self::getEndpointId(),
            'endpointName' => self::getEndpointName(),
            'direction' => self::getDirection(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'destinationId' => self::getDestination() ? self::getDestination()->getId() : null,
            'ratingPlanGroupId' => self::getRatingPlanGroup() ? self::getRatingPlanGroup()->getId() : null,
            'invoiceId' => self::getInvoice() ? self::getInvoice()->getId() : null,
            'trunksCdrId' => self::getTrunksCdr() ? self::getTrunksCdr()->getId() : null,
            'ddiId' => self::getDdi() ? self::getDdi()->getId() : null,
            'ddiProviderId' => self::getDdiProvider() ? self::getDdiProvider()->getId() : null
        ];
    }

    protected function setCallid(?string $callid = null): static
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    protected function setStartTime($startTime = null): static
    {
        if (!is_null($startTime)) {
            Assertion::notNull(
                $startTime,
                'startTime value "%s" is null, but non null value was expected.'
            );
            $startTime = DateTimeHelper::createOrFix(
                $startTime,
                null
            );

            if ($this->startTime == $startTime) {
                return $this;
            }
        }

        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getStartTime(): ?\DateTimeInterface
    {
        return !is_null($this->startTime) ? clone $this->startTime : null;
    }

    protected function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    protected function setCaller(?string $caller = null): static
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    protected function setCallee(?string $callee = null): static
    {
        if (!is_null($callee)) {
            Assertion::maxLength($callee, 128, 'callee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    protected function setCost(?float $cost = null): static
    {
        if (!is_null($cost)) {
            $cost = (float) $cost;
        }

        $this->cost = $cost;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    protected function setPrice(?float $price = null): static
    {
        if (!is_null($price)) {
            $price = (float) $price;
        }

        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    protected function setPriceDetails(?array $priceDetails = null): static
    {
        $this->priceDetails = $priceDetails;

        return $this;
    }

    public function getPriceDetails(): ?array
    {
        return $this->priceDetails;
    }

    protected function setCarrierName(?string $carrierName = null): static
    {
        if (!is_null($carrierName)) {
            Assertion::maxLength($carrierName, 200, 'carrierName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->carrierName = $carrierName;

        return $this;
    }

    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    protected function setDestinationName(?string $destinationName = null): static
    {
        if (!is_null($destinationName)) {
            Assertion::maxLength($destinationName, 100, 'destinationName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationName = $destinationName;

        return $this;
    }

    public function getDestinationName(): ?string
    {
        return $this->destinationName;
    }

    protected function setRatingPlanName(?string $ratingPlanName = null): static
    {
        if (!is_null($ratingPlanName)) {
            Assertion::maxLength($ratingPlanName, 55, 'ratingPlanName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ratingPlanName = $ratingPlanName;

        return $this;
    }

    public function getRatingPlanName(): ?string
    {
        return $this->ratingPlanName;
    }

    protected function setEndpointType(?string $endpointType = null): static
    {
        if (!is_null($endpointType)) {
            Assertion::maxLength($endpointType, 55, 'endpointType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $endpointType,
                [
                    BillableCallInterface::ENDPOINTTYPE_RETAILACCOUNT,
                    BillableCallInterface::ENDPOINTTYPE_RESIDENTIALDEVICE,
                    BillableCallInterface::ENDPOINTTYPE_USER,
                    BillableCallInterface::ENDPOINTTYPE_FRIEND,
                    BillableCallInterface::ENDPOINTTYPE_FAX,
                ],
                'endpointTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->endpointType = $endpointType;

        return $this;
    }

    public function getEndpointType(): ?string
    {
        return $this->endpointType;
    }

    protected function setEndpointId(?int $endpointId = null): static
    {
        if (!is_null($endpointId)) {
            Assertion::greaterOrEqualThan($endpointId, 0, 'endpointId provided "%s" is not greater or equal than "%s".');
        }

        $this->endpointId = $endpointId;

        return $this;
    }

    public function getEndpointId(): ?int
    {
        return $this->endpointId;
    }

    protected function setEndpointName(?string $endpointName = null): static
    {
        if (!is_null($endpointName)) {
            Assertion::maxLength($endpointName, 65, 'endpointName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->endpointName = $endpointName;

        return $this;
    }

    public function getEndpointName(): ?string
    {
        return $this->endpointName;
    }

    protected function setDirection(?string $direction = null): static
    {
        if (!is_null($direction)) {
            Assertion::choice(
                $direction,
                [
                    BillableCallInterface::DIRECTION_INBOUND,
                    BillableCallInterface::DIRECTION_OUTBOUND,
                ],
                'directionvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    protected function setDestination(?DestinationInterface $destination = null): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): ?DestinationInterface
    {
        return $this->destination;
    }

    protected function setRatingPlanGroup(?RatingPlanGroupInterface $ratingPlanGroup = null): static
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    public function getRatingPlanGroup(): ?RatingPlanGroupInterface
    {
        return $this->ratingPlanGroup;
    }

    protected function setInvoice(?InvoiceInterface $invoice = null): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getInvoice(): ?InvoiceInterface
    {
        return $this->invoice;
    }

    protected function setTrunksCdr(?TrunksCdrInterface $trunksCdr = null): static
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    public function getTrunksCdr(): ?TrunksCdrInterface
    {
        return $this->trunksCdr;
    }

    protected function setDdi(?DdiInterface $ddi = null): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }

    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }
}
