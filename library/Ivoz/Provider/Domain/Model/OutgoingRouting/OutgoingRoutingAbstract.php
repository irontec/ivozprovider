<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * OutgoingRoutingAbstract
 * @codeCoverageIgnore
 */
abstract class OutgoingRoutingAbstract
{
    /**
     * @var string | null
     */
    protected $type = 'group';

    /**
     * @var integer
     */
    protected $priority;

    /**
     * @var integer
     */
    protected $weight = 1;

    /**
     * comment: enum:static|lcr|block
     * @var string | null
     */
    protected $routingMode = 'static';

    /**
     * @var string | null
     */
    protected $prefix;

    /**
     * @var boolean
     */
    protected $stopper = false;

    /**
     * @var boolean | null
     */
    protected $forceClid = false;

    /**
     * @var string | null
     */
    protected $clid;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null
     */
    protected $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface | null
     */
    protected $routingPatternGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface | null
     */
    protected $routingTag;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $clidCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($priority, $weight, $stopper)
    {
        $this->setPriority($priority);
        $this->setWeight($weight);
        $this->setStopper($stopper);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "OutgoingRouting",
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
     * @return OutgoingRoutingDto
     */
    public static function createDto($id = null)
    {
        return new OutgoingRoutingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingRoutingInterface|null $entity
     * @param int $depth
     * @return OutgoingRoutingDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, OutgoingRoutingInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var OutgoingRoutingDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingRoutingDto::class);

        $self = new static(
            $dto->getPriority(),
            $dto->getWeight(),
            $dto->getStopper()
        );

        $self
            ->setType($dto->getType())
            ->setRoutingMode($dto->getRoutingMode())
            ->setPrefix($dto->getPrefix())
            ->setForceClid($dto->getForceClid())
            ->setClid($dto->getClid())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRoutingPattern($fkTransformer->transform($dto->getRoutingPattern()))
            ->setRoutingPatternGroup($fkTransformer->transform($dto->getRoutingPatternGroup()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()))
            ->setClidCountry($fkTransformer->transform($dto->getClidCountry()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingRoutingDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingRoutingDto::class);

        $this
            ->setType($dto->getType())
            ->setPriority($dto->getPriority())
            ->setWeight($dto->getWeight())
            ->setRoutingMode($dto->getRoutingMode())
            ->setPrefix($dto->getPrefix())
            ->setStopper($dto->getStopper())
            ->setForceClid($dto->getForceClid())
            ->setClid($dto->getClid())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRoutingPattern($fkTransformer->transform($dto->getRoutingPattern()))
            ->setRoutingPatternGroup($fkTransformer->transform($dto->getRoutingPatternGroup()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()))
            ->setClidCountry($fkTransformer->transform($dto->getClidCountry()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return OutgoingRoutingDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setType(self::getType())
            ->setPriority(self::getPriority())
            ->setWeight(self::getWeight())
            ->setRoutingMode(self::getRoutingMode())
            ->setPrefix(self::getPrefix())
            ->setStopper(self::getStopper())
            ->setForceClid(self::getForceClid())
            ->setClid(self::getClid())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern::entityToDto(self::getRoutingPattern(), $depth))
            ->setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup::entityToDto(self::getRoutingPatternGroup(), $depth))
            ->setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag::entityToDto(self::getRoutingTag(), $depth))
            ->setClidCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getClidCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'type' => self::getType(),
            'priority' => self::getPriority(),
            'weight' => self::getWeight(),
            'routingMode' => self::getRoutingMode(),
            'prefix' => self::getPrefix(),
            'stopper' => self::getStopper(),
            'forceClid' => self::getForceClid(),
            'clid' => self::getClid(),
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'routingPatternId' => self::getRoutingPattern() ? self::getRoutingPattern()->getId() : null,
            'routingPatternGroupId' => self::getRoutingPatternGroup() ? self::getRoutingPatternGroup()->getId() : null,
            'routingTagId' => self::getRoutingTag() ? self::getRoutingTag()->getId() : null,
            'clidCountryId' => self::getClidCountry() ? self::getClidCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set type
     *
     * @param string $type | null
     *
     * @return static
     */
    protected function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string | null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return static
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');

        $this->priority = (int) $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return static
     */
    protected function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = (int) $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set routingMode
     *
     * @param string $routingMode | null
     *
     * @return static
     */
    protected function setRoutingMode($routingMode = null)
    {
        if (!is_null($routingMode)) {
            Assertion::maxLength($routingMode, 25, 'routingMode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($routingMode, [
                OutgoingRoutingInterface::ROUTINGMODE_STATIC,
                OutgoingRoutingInterface::ROUTINGMODE_LCR,
                OutgoingRoutingInterface::ROUTINGMODE_BLOCK
            ], 'routingModevalue "%s" is not an element of the valid values: %s');
        }

        $this->routingMode = $routingMode;

        return $this;
    }

    /**
     * Get routingMode
     *
     * @return string | null
     */
    public function getRoutingMode()
    {
        return $this->routingMode;
    }

    /**
     * Set prefix
     *
     * @param string $prefix | null
     *
     * @return static
     */
    protected function setPrefix($prefix = null)
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 25, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set stopper
     *
     * @param boolean $stopper
     *
     * @return static
     */
    protected function setStopper($stopper)
    {
        Assertion::notNull($stopper, 'stopper value "%s" is null, but non null value was expected.');
        Assertion::between(intval($stopper), 0, 1, 'stopper provided "%s" is not a valid boolean value.');
        $stopper = (bool) $stopper;

        $this->stopper = $stopper;

        return $this;
    }

    /**
     * Get stopper
     *
     * @return boolean
     */
    public function getStopper()
    {
        return $this->stopper;
    }

    /**
     * Set forceClid
     *
     * @param boolean $forceClid | null
     *
     * @return static
     */
    protected function setForceClid($forceClid = null)
    {
        if (!is_null($forceClid)) {
            Assertion::between(intval($forceClid), 0, 1, 'forceClid provided "%s" is not a valid boolean value.');
            $forceClid = (bool) $forceClid;
        }

        $this->forceClid = $forceClid;

        return $this;
    }

    /**
     * Get forceClid
     *
     * @return boolean | null
     */
    public function getForceClid()
    {
        return $this->forceClid;
    }

    /**
     * Set clid
     *
     * @param string $clid | null
     *
     * @return static
     */
    protected function setClid($clid = null)
    {
        if (!is_null($clid)) {
            Assertion::maxLength($clid, 25, 'clid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->clid = $clid;

        return $this;
    }

    /**
     * Get clid
     *
     * @return string | null
     */
    public function getClid()
    {
        return $this->clid;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier | null
     *
     * @return static
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
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern | null
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null)
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface | null
     */
    public function getRoutingPatternGroup()
    {
        return $this->routingPatternGroup;
    }

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag | null
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null)
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface | null
     */
    public function getRoutingTag()
    {
        return $this->routingTag;
    }

    /**
     * Set clidCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $clidCountry | null
     *
     * @return static
     */
    protected function setClidCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $clidCountry = null)
    {
        $this->clidCountry = $clidCountry;

        return $this;
    }

    /**
     * Get clidCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getClidCountry()
    {
        return $this->clidCountry;
    }

    // @codeCoverageIgnoreEnd
}
