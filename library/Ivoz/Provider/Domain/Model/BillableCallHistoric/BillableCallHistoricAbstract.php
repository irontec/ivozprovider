<?php

namespace Ivoz\Provider\Domain\Model\BillableCallHistoric;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BillableCallHistoricAbstract
 * @codeCoverageIgnore
 */
abstract class BillableCallHistoricAbstract
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
    protected $duration = 0.0;

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
     * comment: enum:RetailAccount|ResidentialDevice|User|Friend|Fax
     * @var string | null
     */
    protected $endpointType;

    /**
     * @var integer | null
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
     * column: brandId
     * @var integer | null
     */
    protected $brand;

    /**
     * column: companyId
     * @var integer | null
     */
    protected $company;

    /**
     * column: carrierId
     * @var integer | null
     */
    protected $carrier;

    /**
     * column: destinationId
     * @var integer | null
     */
    protected $destination;

    /**
     * column: ratingPlanGroupId
     * @var integer | null
     */
    protected $ratingPlanGroup;

    /**
     * column: invoiceId
     * @var integer | null
     */
    protected $invoice;

    /**
     * column: trunksCdrId
     * @var integer | null
     */
    protected $trunksCdr;

    /**
     * column: ddiId
     * @var integer | null
     */
    protected $ddi;

    /**
     * column: ddiProviderId
     * @var integer | null
     */
    protected $ddiProvider;


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
            "BillableCallHistoric",
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
     * @return BillableCallHistoricDto
     */
    public static function createDto($id = null)
    {
        return new BillableCallHistoricDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BillableCallHistoricInterface|null $entity
     * @param int $depth
     * @return BillableCallHistoricDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BillableCallHistoricInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var BillableCallHistoricDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BillableCallHistoricDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BillableCallHistoricDto::class);

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
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
            ->setDestination($dto->getDestination())
            ->setRatingPlanGroup($dto->getRatingPlanGroup())
            ->setInvoice($dto->getInvoice())
            ->setTrunksCdr($dto->getTrunksCdr())
            ->setDdi($dto->getDdi())
            ->setDdiProvider($dto->getDdiProvider())
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BillableCallHistoricDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BillableCallHistoricDto::class);

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
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
            ->setDestination($dto->getDestination())
            ->setRatingPlanGroup($dto->getRatingPlanGroup())
            ->setInvoice($dto->getInvoice())
            ->setTrunksCdr($dto->getTrunksCdr())
            ->setDdi($dto->getDdi())
            ->setDdiProvider($dto->getDdiProvider());



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return BillableCallHistoricDto
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
            ->setBrand(self::getBrand())
            ->setCompany(self::getCompany())
            ->setCarrier(self::getCarrier())
            ->setDestination(self::getDestination())
            ->setRatingPlanGroup(self::getRatingPlanGroup())
            ->setInvoice(self::getInvoice())
            ->setTrunksCdr(self::getTrunksCdr())
            ->setDdi(self::getDdi())
            ->setDdiProvider(self::getDdiProvider());
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
            'brandId' => self::getBrand(),
            'companyId' => self::getCompany(),
            'carrierId' => self::getCarrier(),
            'destinationId' => self::getDestination(),
            'ratingPlanGroupId' => self::getRatingPlanGroup(),
            'invoiceId' => self::getInvoice(),
            'trunksCdrId' => self::getTrunksCdr(),
            'ddiId' => self::getDdi(),
            'ddiProviderId' => self::getDdiProvider()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set callid
     *
     * @param string $callid | null
     *
     * @return static
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
     * @param \DateTime $startTime | null
     *
     * @return static
     */
    protected function setStartTime($startTime = null)
    {
        if (!is_null($startTime)) {
            $startTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
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
     * @return static
     */
    protected function setDuration($duration)
    {
        Assertion::notNull($duration, 'duration value "%s" is null, but non null value was expected.');
        Assertion::numeric($duration);

        $this->duration = (float) $duration;

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
     * @param string $callee | null
     *
     * @return static
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
     * @param float $cost | null
     *
     * @return static
     */
    protected function setCost($cost = null)
    {
        if (!is_null($cost)) {
            Assertion::numeric($cost);
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
    public function getCost()
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
    protected function setPrice($price = null)
    {
        if (!is_null($price)) {
            Assertion::numeric($price);
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
    public function getPrice()
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
    protected function setPriceDetails($priceDetails = null)
    {
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
     * @param string $carrierName | null
     *
     * @return static
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
     * @param string $destinationName | null
     *
     * @return static
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
     * @param string $ratingPlanName | null
     *
     * @return static
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
     * @param string $endpointType | null
     *
     * @return static
     */
    protected function setEndpointType($endpointType = null)
    {
        if (!is_null($endpointType)) {
            Assertion::maxLength($endpointType, 55, 'endpointType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($endpointType, [
                BillableCallHistoricInterface::ENDPOINTTYPE_RETAILACCOUNT,
                BillableCallHistoricInterface::ENDPOINTTYPE_RESIDENTIALDEVICE,
                BillableCallHistoricInterface::ENDPOINTTYPE_USER,
                BillableCallHistoricInterface::ENDPOINTTYPE_FRIEND,
                BillableCallHistoricInterface::ENDPOINTTYPE_FAX
            ], 'endpointTypevalue "%s" is not an element of the valid values: %s');
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
     * @param integer $endpointId | null
     *
     * @return static
     */
    protected function setEndpointId($endpointId = null)
    {
        if (!is_null($endpointId)) {
            Assertion::integerish($endpointId, 'endpointId value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($endpointId, 0, 'endpointId provided "%s" is not greater or equal than "%s".');
            $endpointId = (int) $endpointId;
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
     * Set endpointName
     *
     * @param string $endpointName | null
     *
     * @return static
     */
    protected function setEndpointName($endpointName = null)
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
    public function getEndpointName()
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
    protected function setDirection($direction = null)
    {
        if (!is_null($direction)) {
            Assertion::choice($direction, [
                BillableCallHistoricInterface::DIRECTION_INBOUND,
                BillableCallHistoricInterface::DIRECTION_OUTBOUND
            ], 'directionvalue "%s" is not an element of the valid values: %s');
        }

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set brand
     *
     * @param integer $brand | null
     *
     * @return static
     */
    protected function setBrand($brand = null)
    {
        if (!is_null($brand)) {
            Assertion::integerish($brand, 'brand value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($brand, 0, 'brand provided "%s" is not greater or equal than "%s".');
            $brand = (int) $brand;
        }

        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return integer | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param integer $company | null
     *
     * @return static
     */
    protected function setCompany($company = null)
    {
        if (!is_null($company)) {
            Assertion::integerish($company, 'company value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($company, 0, 'company provided "%s" is not greater or equal than "%s".');
            $company = (int) $company;
        }

        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return integer | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param integer $carrier | null
     *
     * @return static
     */
    protected function setCarrier($carrier = null)
    {
        if (!is_null($carrier)) {
            Assertion::integerish($carrier, 'carrier value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($carrier, 0, 'carrier provided "%s" is not greater or equal than "%s".');
            $carrier = (int) $carrier;
        }

        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return integer | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set destination
     *
     * @param integer $destination | null
     *
     * @return static
     */
    protected function setDestination($destination = null)
    {
        if (!is_null($destination)) {
            Assertion::integerish($destination, 'destination value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($destination, 0, 'destination provided "%s" is not greater or equal than "%s".');
            $destination = (int) $destination;
        }

        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return integer | null
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param integer $ratingPlanGroup | null
     *
     * @return static
     */
    protected function setRatingPlanGroup($ratingPlanGroup = null)
    {
        if (!is_null($ratingPlanGroup)) {
            Assertion::integerish($ratingPlanGroup, 'ratingPlanGroup value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($ratingPlanGroup, 0, 'ratingPlanGroup provided "%s" is not greater or equal than "%s".');
            $ratingPlanGroup = (int) $ratingPlanGroup;
        }

        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return integer | null
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * Set invoice
     *
     * @param integer $invoice | null
     *
     * @return static
     */
    protected function setInvoice($invoice = null)
    {
        if (!is_null($invoice)) {
            Assertion::integerish($invoice, 'invoice value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($invoice, 0, 'invoice provided "%s" is not greater or equal than "%s".');
            $invoice = (int) $invoice;
        }

        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return integer | null
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set trunksCdr
     *
     * @param integer $trunksCdr | null
     *
     * @return static
     */
    protected function setTrunksCdr($trunksCdr = null)
    {
        if (!is_null($trunksCdr)) {
            Assertion::integerish($trunksCdr, 'trunksCdr value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($trunksCdr, 0, 'trunksCdr provided "%s" is not greater or equal than "%s".');
            $trunksCdr = (int) $trunksCdr;
        }

        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    /**
     * Get trunksCdr
     *
     * @return integer | null
     */
    public function getTrunksCdr()
    {
        return $this->trunksCdr;
    }

    /**
     * Set ddi
     *
     * @param integer $ddi | null
     *
     * @return static
     */
    protected function setDdi($ddi = null)
    {
        if (!is_null($ddi)) {
            Assertion::integerish($ddi, 'ddi value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($ddi, 0, 'ddi provided "%s" is not greater or equal than "%s".');
            $ddi = (int) $ddi;
        }

        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return integer | null
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * Set ddiProvider
     *
     * @param integer $ddiProvider | null
     *
     * @return static
     */
    protected function setDdiProvider($ddiProvider = null)
    {
        if (!is_null($ddiProvider)) {
            Assertion::integerish($ddiProvider, 'ddiProvider value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($ddiProvider, 0, 'ddiProvider provided "%s" is not greater or equal than "%s".');
            $ddiProvider = (int) $ddiProvider;
        }

        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return integer | null
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    // @codeCoverageIgnoreEnd
}
