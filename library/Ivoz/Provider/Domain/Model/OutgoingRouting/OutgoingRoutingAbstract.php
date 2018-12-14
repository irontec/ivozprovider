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
    protected $weight = '1';

    /**
     * comment: enum:static|lcr
     * @var string | null
     */
    protected $routingMode = 'static';

    /**
     * @var string | null
     */
    protected $prefix;

    /**
     * @var boolean | null
     */
    protected $forceClid = '0';

    /**
     * @var string | null
     */
    protected $clid;

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
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    protected $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface
     */
    protected $routingPatternGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    protected $routingTag;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $clidCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($priority, $weight)
    {
        $this->setPriority($priority);
        $this->setWeight($weight);
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingRoutingDto
         */
        Assertion::isInstanceOf($dto, OutgoingRoutingDto::class);

        $self = new static(
            $dto->getPriority(),
            $dto->getWeight()
        );

        $self
            ->setType($dto->getType())
            ->setRoutingMode($dto->getRoutingMode())
            ->setPrefix($dto->getPrefix())
            ->setForceClid($dto->getForceClid())
            ->setClid($dto->getClid())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
            ->setRoutingPattern($dto->getRoutingPattern())
            ->setRoutingPatternGroup($dto->getRoutingPatternGroup())
            ->setRoutingTag($dto->getRoutingTag())
            ->setClidCountry($dto->getClidCountry())
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingRoutingDto
         */
        Assertion::isInstanceOf($dto, OutgoingRoutingDto::class);

        $this
            ->setType($dto->getType())
            ->setPriority($dto->getPriority())
            ->setWeight($dto->getWeight())
            ->setRoutingMode($dto->getRoutingMode())
            ->setPrefix($dto->getPrefix())
            ->setForceClid($dto->getForceClid())
            ->setClid($dto->getClid())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
            ->setRoutingPattern($dto->getRoutingPattern())
            ->setRoutingPatternGroup($dto->getRoutingPatternGroup())
            ->setRoutingTag($dto->getRoutingTag())
            ->setClidCountry($dto->getClidCountry());



        $this->sanitizeValues();
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
            'forceClid' => self::getForceClid(),
            'clid' => self::getClid(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
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
     * @param string $type
     *
     * @return self
     */
    protected function setType($type = null)
    {
        if (!is_null($type)) {
        }

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
     * @return self
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');

        $this->priority = $priority;

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
     * @return self
     */
    protected function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

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
     * @param string $routingMode
     *
     * @return self
     */
    protected function setRoutingMode($routingMode = null)
    {
        if (!is_null($routingMode)) {
            Assertion::maxLength($routingMode, 25, 'routingMode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($routingMode, array (
              0 => 'static',
              1 => 'lcr',
            ), 'routingModevalue "%s" is not an element of the valid values: %s');
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
     * @param string $prefix
     *
     * @return self
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
     * Set forceClid
     *
     * @param boolean $forceClid
     *
     * @return self
     */
    protected function setForceClid($forceClid = null)
    {
        if (!is_null($forceClid)) {
            Assertion::between(intval($forceClid), 0, 1, 'forceClid provided "%s" is not a valid boolean value.');
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
     * @param string $clid
     *
     * @return self
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
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
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
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup
     *
     * @return self
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null)
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface
     */
    public function getRoutingPatternGroup()
    {
        return $this->routingPatternGroup;
    }

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag
     *
     * @return self
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null)
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    public function getRoutingTag()
    {
        return $this->routingTag;
    }

    /**
     * Set clidCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $clidCountry
     *
     * @return self
     */
    public function setClidCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $clidCountry = null)
    {
        $this->clidCountry = $clidCountry;

        return $this;
    }

    /**
     * Get clidCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getClidCountry()
    {
        return $this->clidCountry;
    }

    // @codeCoverageIgnoreEnd
}
