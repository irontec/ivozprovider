<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BillableCallAbstract
 * @codeCoverageIgnore
 */
abstract class BillableCallAbstract
{
    /**
     * @var string | null
     */
    protected $callid;

    /**
     * @var \DateTime | null
     */
    protected $startTime;

    /**
     * @var float
     */
    protected $duration = '0.000';

    /**
     * @var string | null
     */
    protected $caller;

    /**
     * @var string | null
     */
    protected $callee;

    /**
     * @var string | null
     */
    protected $cost;

    /**
     * @var string | null
     */
    protected $price;

    /**
     * @var array | null
     */
    protected $priceDetails;

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
     * @var string | null
     */
    protected $endpointType;

    /**
     * @var integer | null
     */
    protected $endpointId;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\Destination\DestinationInterface
     */
    protected $destination;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface
     */
    protected $invoice;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface
     */
    protected $trunksCdr;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($duration)
    {
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto BillableCallDto
         */
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
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setDestination($fkTransformer->transform($dto->getDestination()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setInvoice($fkTransformer->transform($dto->getInvoice()))
            ->setTrunksCdr($fkTransformer->transform($dto->getTrunksCdr()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto BillableCallDto
         */
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
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setDestination($fkTransformer->transform($dto->getDestination()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setInvoice($fkTransformer->transform($dto->getInvoice()))
            ->setTrunksCdr($fkTransformer->transform($dto->getTrunksCdr()));



        $this->sanitizeValues();
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
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
            ->setDestination(\Ivoz\Provider\Domain\Model\Destination\Destination::entityToDto(self::getDestination(), $depth))
            ->setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setInvoice(\Ivoz\Provider\Domain\Model\Invoice\Invoice::entityToDto(self::getInvoice(), $depth))
            ->setTrunksCdr(\Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr::entityToDto(self::getTrunksCdr(), $depth));
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
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'destinationId' => self::getDestination() ? self::getDestination()->getId() : null,
            'ratingPlanGroupId' => self::getRatingPlanGroup() ? self::getRatingPlanGroup()->getId() : null,
            'invoiceId' => self::getInvoice() ? self::getInvoice()->getId() : null,
            'trunksCdrId' => self::getTrunksCdr() ? self::getTrunksCdr()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    protected function setCallid($callid = null)
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
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return self
     */
    protected function setStartTime($startTime = null)
    {
        if (!is_null($startTime)) {
            $startTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $startTime,
                null
            );
        }

        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime | null
     */
    public function getStartTime()
    {
        return !is_null($this->startTime) ? clone $this->startTime : null;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return self
     */
    protected function setDuration($duration)
    {
        Assertion::notNull($duration, 'duration value "%s" is null, but non null value was expected.');
        Assertion::numeric($duration);
        $duration = (float) $duration;

        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set caller
     *
     * @param string $caller
     *
     * @return self
     */
    protected function setCaller($caller = null)
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
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * Set callee
     *
     * @param string $callee
     *
     * @return self
     */
    protected function setCallee($callee = null)
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
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return self
     */
    protected function setCost($cost = null)
    {
        if (!is_null($cost)) {
            if (!is_null($cost)) {
                Assertion::numeric($cost);
                $cost = (float) $cost;
            }
        }

        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string | null
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return self
     */
    protected function setPrice($price = null)
    {
        if (!is_null($price)) {
            if (!is_null($price)) {
                Assertion::numeric($price);
                $price = (float) $price;
            }
        }

        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string | null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceDetails
     *
     * @param array $priceDetails
     *
     * @return self
     */
    protected function setPriceDetails($priceDetails = null)
    {
        if (!is_null($priceDetails)) {
        }

        $this->priceDetails = $priceDetails;

        return $this;
    }

    /**
     * Get priceDetails
     *
     * @return array | null
     */
    public function getPriceDetails()
    {
        return $this->priceDetails;
    }

    /**
     * Set carrierName
     *
     * @param string $carrierName
     *
     * @return self
     */
    protected function setCarrierName($carrierName = null)
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
    public function getCarrierName()
    {
        return $this->carrierName;
    }

    /**
     * Set destinationName
     *
     * @param string $destinationName
     *
     * @return self
     */
    protected function setDestinationName($destinationName = null)
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
    public function getDestinationName()
    {
        return $this->destinationName;
    }

    /**
     * Set ratingPlanName
     *
     * @param string $ratingPlanName
     *
     * @return self
     */
    protected function setRatingPlanName($ratingPlanName = null)
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
    public function getRatingPlanName()
    {
        return $this->ratingPlanName;
    }

    /**
     * Set endpointType
     *
     * @param string $endpointType
     *
     * @return self
     */
    protected function setEndpointType($endpointType = null)
    {
        if (!is_null($endpointType)) {
            Assertion::maxLength($endpointType, 55, 'endpointType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->endpointType = $endpointType;

        return $this;
    }

    /**
     * Get endpointType
     *
     * @return string | null
     */
    public function getEndpointType()
    {
        return $this->endpointType;
    }

    /**
     * Set endpointId
     *
     * @param integer $endpointId
     *
     * @return self
     */
    protected function setEndpointId($endpointId = null)
    {
        if (!is_null($endpointId)) {
            if (!is_null($endpointId)) {
                Assertion::integerish($endpointId, 'endpointId value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($endpointId, 0, 'endpointId provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * Get endpointId
     *
     * @return integer | null
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set destination
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface | null
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup
     *
     * @return self
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup = null)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface | null
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice
     *
     * @return self
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface | null
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set trunksCdr
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface $trunksCdr
     *
     * @return self
     */
    public function setTrunksCdr(\Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface $trunksCdr = null)
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    /**
     * Get trunksCdr
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface | null
     */
    public function getTrunksCdr()
    {
        return $this->trunksCdr;
    }

    // @codeCoverageIgnoreEnd
}
