<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* OutgoingRoutingAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingRoutingAbstract
{
    use ChangelogTrait;

    /**
     * @var string | null
     */
    protected $type = 'group';

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var int
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
     * @var bool
     */
    protected $stopper = false;

    /**
     * @var bool | null
     */
    protected $forceClid = false;

    /**
     * @var string | null
     */
    protected $clid;

    /**
     * @var BrandInterface
     * inversedBy outgoingRoutings
     */
    protected $brand;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

    /**
     * @var CarrierInterface | null
     * inversedBy outgoingRoutings
     */
    protected $carrier;

    /**
     * @var RoutingPatternInterface | null
     * inversedBy outgoingRoutings
     */
    protected $routingPattern;

    /**
     * @var RoutingPatternGroupInterface | null
     * inversedBy outgoingRoutings
     */
    protected $routingPatternGroup;

    /**
     * @var RoutingTagInterface | null
     * inversedBy outgoingRoutings
     */
    protected $routingTag;

    /**
     * @var CountryInterface | null
     */
    protected $clidCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $priority,
        $weight,
        $stopper
    ) {
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
     * @param mixed $id
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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setClidCountry($fkTransformer->transform($dto->getClidCountry()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRoutingPattern(RoutingPattern::entityToDto(self::getRoutingPattern(), $depth))
            ->setRoutingPatternGroup(RoutingPatternGroup::entityToDto(self::getRoutingPatternGroup(), $depth))
            ->setRoutingTag(RoutingTag::entityToDto(self::getRoutingTag(), $depth))
            ->setClidCountry(Country::entityToDto(self::getClidCountry(), $depth));
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

    protected function setType(?string $type = null): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    protected function setPriority(int $priority): static
    {
        Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');

        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    protected function setWeight(int $weight): static
    {
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    protected function setRoutingMode(?string $routingMode = null): static
    {
        if (!is_null($routingMode)) {
            Assertion::maxLength($routingMode, 25, 'routingMode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routingMode,
                [
                    OutgoingRoutingInterface::ROUTINGMODE_STATIC,
                    OutgoingRoutingInterface::ROUTINGMODE_LCR,
                    OutgoingRoutingInterface::ROUTINGMODE_BLOCK,
                ],
                'routingModevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->routingMode = $routingMode;

        return $this;
    }

    public function getRoutingMode(): ?string
    {
        return $this->routingMode;
    }

    protected function setPrefix(?string $prefix = null): static
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 25, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    protected function setStopper(bool $stopper): static
    {
        Assertion::between(intval($stopper), 0, 1, 'stopper provided "%s" is not a valid boolean value.');
        $stopper = (bool) $stopper;

        $this->stopper = $stopper;

        return $this;
    }

    public function getStopper(): bool
    {
        return $this->stopper;
    }

    protected function setForceClid(?bool $forceClid = null): static
    {
        if (!is_null($forceClid)) {
            Assertion::between(intval($forceClid), 0, 1, 'forceClid provided "%s" is not a valid boolean value.');
            $forceClid = (bool) $forceClid;
        }

        $this->forceClid = $forceClid;

        return $this;
    }

    public function getForceClid(): ?bool
    {
        return $this->forceClid;
    }

    protected function setClid(?string $clid = null): static
    {
        if (!is_null($clid)) {
            Assertion::maxLength($clid, 25, 'clid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->clid = $clid;

        return $this;
    }

    public function getClid(): ?string
    {
        return $this->clid;
    }

    public function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        /** @var  $this */
        return $this;
    }

    public function getBrand(): BrandInterface
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

    public function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        /** @var  $this */
        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): static
    {
        $this->routingPattern = $routingPattern;

        /** @var  $this */
        return $this;
    }

    public function getRoutingPattern(): ?RoutingPatternInterface
    {
        return $this->routingPattern;
    }

    public function setRoutingPatternGroup(?RoutingPatternGroupInterface $routingPatternGroup = null): static
    {
        $this->routingPatternGroup = $routingPatternGroup;

        /** @var  $this */
        return $this;
    }

    public function getRoutingPatternGroup(): ?RoutingPatternGroupInterface
    {
        return $this->routingPatternGroup;
    }

    public function setRoutingTag(?RoutingTagInterface $routingTag = null): static
    {
        $this->routingTag = $routingTag;

        /** @var  $this */
        return $this;
    }

    public function getRoutingTag(): ?RoutingTagInterface
    {
        return $this->routingTag;
    }

    protected function setClidCountry(?CountryInterface $clidCountry = null): static
    {
        $this->clidCountry = $clidCountry;

        return $this;
    }

    public function getClidCountry(): ?CountryInterface
    {
        return $this->clidCountry;
    }

}
