<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    /**
     * @var string | null
     */
    protected $callid;

    /**
     * @var \DateTimeInterface | null
     */
    protected $startTime;

    /**
     * @var float
     */
    protected $duration = 0;

    /**
     * @var string | null
     */
    protected $caller;

    /**
     * @var string | null
     */
    protected $callee;

    /**
     * @var float | null
     */
    protected $cost;

    /**
     * @var float | null
     */
    protected $price;

    /**
     * @var array | null
     */
    protected $priceDetails = [];

    /**
     * @var string | null
     */
    protected $carrierName;

    /**
     * @var string | null
     */
    protected $destinationName;

    /**
     * @var string | null
     */
    protected $ratingPlanName;

    /**
     * comment: enum:RetailAccount|ResidentialDevice|User|Friend|Fax
     * @var string | null
     */
    protected $endpointType;

    /**
     * @var int | null
     */
    protected $endpointId;

    /**
     * @var string | null
     */
    protected $endpointName;

    /**
     * comment: enum:inbound|outbound
     * @var string | null
     */
    protected $direction = 'outbound';

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var DestinationInterface
     */
    protected $destination;

    /**
     * @var RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var InvoiceInterface
     */
    protected $invoice;

    /**
     * @var TrunksCdrInterface
     */
    protected $trunksCdr;

    /**
     * @var DdiInterface
     */
    protected $ddi;

    /**
     * @var DdiProviderInterface
     */
    protected $ddiProvider;

    /**
     * Constructor
     */
    protected function __construct(
        $duration
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
     * @param null $id
     * @return BillableCallDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return BillableCallDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set callid
     *
     * @param string $callid | null
     *
     * @return static
     */
    protected function setCallid(?string $callid = null): BillableCallInterface
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * Set startTime
     *
     * @param \DateTimeInterface $startTime | null
     *
     * @return static
     */
    protected function setStartTime($startTime = null): BillableCallInterface
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
     * Get startTime
     *
     * @return \DateTimeInterface | null
     */
    public function getStartTime(): ?\DateTimeInterface
    {
        return !is_null($this->startTime) ? clone $this->startTime : null;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return static
     */
    protected function setDuration(float $duration): BillableCallInterface
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * Set caller
     *
     * @param string $caller | null
     *
     * @return static
     */
    protected function setCaller(?string $caller = null): BillableCallInterface
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->caller = $caller;

        return $this;
    }

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller(): ?string
    {
        return $this->caller;
    }

    /**
     * Set callee
     *
     * @param string $callee | null
     *
     * @return static
     */
    protected function setCallee(?string $callee = null): BillableCallInterface
    {
        if (!is_null($callee)) {
            Assertion::maxLength($callee, 128, 'callee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callee = $callee;

        return $this;
    }

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee(): ?string
    {
        return $this->callee;
    }

    /**
     * Set cost
     *
     * @param float $cost | null
     *
     * @return static
     */
    protected function setCost(?float $cost = null): BillableCallInterface
    {
        if (!is_null($cost)) {
            $cost = (float) $cost;
        }

        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float | null
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * Set price
     *
     * @param float $price | null
     *
     * @return static
     */
    protected function setPrice(?float $price = null): BillableCallInterface
    {
        if (!is_null($price)) {
            $price = (float) $price;
        }

        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float | null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set priceDetails
     *
     * @param array $priceDetails | null
     *
     * @return static
     */
    protected function setPriceDetails(?array $priceDetails = null): BillableCallInterface
    {
        $this->priceDetails = $priceDetails;

        return $this;
    }

    /**
     * Get priceDetails
     *
     * @return array | null
     */
    public function getPriceDetails(): ?array
    {
        return $this->priceDetails;
    }

    /**
     * Set carrierName
     *
     * @param string $carrierName | null
     *
     * @return static
     */
    protected function setCarrierName(?string $carrierName = null): BillableCallInterface
    {
        if (!is_null($carrierName)) {
            Assertion::maxLength($carrierName, 200, 'carrierName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->carrierName = $carrierName;

        return $this;
    }

    /**
     * Get carrierName
     *
     * @return string | null
     */
    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    /**
     * Set destinationName
     *
     * @param string $destinationName | null
     *
     * @return static
     */
    protected function setDestinationName(?string $destinationName = null): BillableCallInterface
    {
        if (!is_null($destinationName)) {
            Assertion::maxLength($destinationName, 100, 'destinationName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationName = $destinationName;

        return $this;
    }

    /**
     * Get destinationName
     *
     * @return string | null
     */
    public function getDestinationName(): ?string
    {
        return $this->destinationName;
    }

    /**
     * Set ratingPlanName
     *
     * @param string $ratingPlanName | null
     *
     * @return static
     */
    protected function setRatingPlanName(?string $ratingPlanName = null): BillableCallInterface
    {
        if (!is_null($ratingPlanName)) {
            Assertion::maxLength($ratingPlanName, 55, 'ratingPlanName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ratingPlanName = $ratingPlanName;

        return $this;
    }

    /**
     * Get ratingPlanName
     *
     * @return string | null
     */
    public function getRatingPlanName(): ?string
    {
        return $this->ratingPlanName;
    }

    /**
     * Set endpointType
     *
     * @param string $endpointType | null
     *
     * @return static
     */
    protected function setEndpointType(?string $endpointType = null): BillableCallInterface
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

    /**
     * Get endpointType
     *
     * @return string | null
     */
    public function getEndpointType(): ?string
    {
        return $this->endpointType;
    }

    /**
     * Set endpointId
     *
     * @param int $endpointId | null
     *
     * @return static
     */
    protected function setEndpointId(?int $endpointId = null): BillableCallInterface
    {
        if (!is_null($endpointId)) {
            Assertion::greaterOrEqualThan($endpointId, 0, 'endpointId provided "%s" is not greater or equal than "%s".');
        }

        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * Get endpointId
     *
     * @return int | null
     */
    public function getEndpointId(): ?int
    {
        return $this->endpointId;
    }

    /**
     * Set endpointName
     *
     * @param string $endpointName | null
     *
     * @return static
     */
    protected function setEndpointName(?string $endpointName = null): BillableCallInterface
    {
        if (!is_null($endpointName)) {
            Assertion::maxLength($endpointName, 65, 'endpointName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->endpointName = $endpointName;

        return $this;
    }

    /**
     * Get endpointName
     *
     * @return string | null
     */
    public function getEndpointName(): ?string
    {
        return $this->endpointName;
    }

    /**
     * Set direction
     *
     * @param string $direction | null
     *
     * @return static
     */
    protected function setDirection(?string $direction = null): BillableCallInterface
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

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): BillableCallInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setCompany(?CompanyInterface $company = null): BillableCallInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    protected function setCarrier(?CarrierInterface $carrier = null): BillableCallInterface
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    /**
     * Set destination
     *
     * @param DestinationInterface | null
     *
     * @return static
     */
    protected function setDestination(?DestinationInterface $destination = null): BillableCallInterface
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return DestinationInterface | null
     */
    public function getDestination(): ?DestinationInterface
    {
        return $this->destination;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param RatingPlanGroupInterface | null
     *
     * @return static
     */
    protected function setRatingPlanGroup(?RatingPlanGroupInterface $ratingPlanGroup = null): BillableCallInterface
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return RatingPlanGroupInterface | null
     */
    public function getRatingPlanGroup(): ?RatingPlanGroupInterface
    {
        return $this->ratingPlanGroup;
    }

    /**
     * Set invoice
     *
     * @param InvoiceInterface | null
     *
     * @return static
     */
    protected function setInvoice(?InvoiceInterface $invoice = null): BillableCallInterface
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return InvoiceInterface | null
     */
    public function getInvoice(): ?InvoiceInterface
    {
        return $this->invoice;
    }

    /**
     * Set trunksCdr
     *
     * @param TrunksCdrInterface | null
     *
     * @return static
     */
    protected function setTrunksCdr(?TrunksCdrInterface $trunksCdr = null): BillableCallInterface
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    /**
     * Get trunksCdr
     *
     * @return TrunksCdrInterface | null
     */
    public function getTrunksCdr(): ?TrunksCdrInterface
    {
        return $this->trunksCdr;
    }

    /**
     * Set ddi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setDdi(?DdiInterface $ddi = null): BillableCallInterface
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return DdiInterface | null
     */
    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }

    /**
     * Set ddiProvider
     *
     * @param DdiProviderInterface | null
     *
     * @return static
     */
    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): BillableCallInterface
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }

}
