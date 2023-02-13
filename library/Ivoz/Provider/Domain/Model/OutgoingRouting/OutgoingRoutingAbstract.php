<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
     * @var ?string
     * comment: enum:pattern|group|fax
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
     * @var ?string
     * comment: enum:static|lcr|block
     */
    protected $routingMode = 'static';

    /**
     * @var ?string
     */
    protected $prefix = null;

    /**
     * @var bool
     */
    protected $stopper = false;

    /**
     * @var ?bool
     */
    protected $forceClid = false;

    /**
     * @var ?string
     */
    protected $clid = null;

    /**
     * @var BrandInterface
     * inversedBy outgoingRoutings
     */
    protected $brand;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

    /**
     * @var ?CarrierInterface
     * inversedBy outgoingRoutings
     */
    protected $carrier = null;

    /**
     * @var ?RoutingPatternInterface
     * inversedBy outgoingRoutings
     */
    protected $routingPattern = null;

    /**
     * @var ?RoutingPatternGroupInterface
     * inversedBy outgoingRoutings
     */
    protected $routingPatternGroup = null;

    /**
     * @var ?RoutingTagInterface
     * inversedBy outgoingRoutings
     */
    protected $routingTag = null;

    /**
     * @var ?CountryInterface
     */
    protected $clidCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        int $priority,
        int $weight,
        bool $stopper
    ) {
        $this->setPriority($priority);
        $this->setWeight($weight);
        $this->setStopper($stopper);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "OutgoingRouting",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): OutgoingRoutingDto
    {
        return new OutgoingRoutingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|OutgoingRoutingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?OutgoingRoutingDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, OutgoingRoutingDto::class);
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $stopper = $dto->getStopper();
        Assertion::notNull($stopper, 'getStopper value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
            $priority,
            $weight,
            $stopper
        );

        $self
            ->setType($dto->getType())
            ->setRoutingMode($dto->getRoutingMode())
            ->setPrefix($dto->getPrefix())
            ->setForceClid($dto->getForceClid())
            ->setClid($dto->getClid())
            ->setBrand($fkTransformer->transform($brand))
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, OutgoingRoutingDto::class);

        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $stopper = $dto->getStopper();
        Assertion::notNull($stopper, 'getStopper value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setType($dto->getType())
            ->setPriority($priority)
            ->setWeight($weight)
            ->setRoutingMode($dto->getRoutingMode())
            ->setPrefix($dto->getPrefix())
            ->setStopper($stopper)
            ->setForceClid($dto->getForceClid())
            ->setClid($dto->getClid())
            ->setBrand($fkTransformer->transform($brand))
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
     */
    public function toDto(int $depth = 0): OutgoingRoutingDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'companyId' => self::getCompany()?->getId(),
            'carrierId' => self::getCarrier()?->getId(),
            'routingPatternId' => self::getRoutingPattern()?->getId(),
            'routingPatternGroupId' => self::getRoutingPatternGroup()?->getId(),
            'routingTagId' => self::getRoutingTag()?->getId(),
            'clidCountryId' => self::getClidCountry()?->getId()
        ];
    }

    protected function setType(?string $type = null): static
    {
        if (!is_null($type)) {
            Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $type,
                [
                    OutgoingRoutingInterface::TYPE_PATTERN,
                    OutgoingRoutingInterface::TYPE_GROUP,
                    OutgoingRoutingInterface::TYPE_FAX,
                ],
                'typevalue "%s" is not an element of the valid values: %s'
            );
        }

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
        $this->stopper = $stopper;

        return $this;
    }

    public function getStopper(): bool
    {
        return $this->stopper;
    }

    protected function setForceClid(?bool $forceClid = null): static
    {
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

        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): static
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    public function getRoutingPattern(): ?RoutingPatternInterface
    {
        return $this->routingPattern;
    }

    public function setRoutingPatternGroup(?RoutingPatternGroupInterface $routingPatternGroup = null): static
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    public function getRoutingPatternGroup(): ?RoutingPatternGroupInterface
    {
        return $this->routingPatternGroup;
    }

    public function setRoutingTag(?RoutingTagInterface $routingTag = null): static
    {
        $this->routingTag = $routingTag;

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
