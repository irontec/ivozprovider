<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Carrier;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\Currency\Currency;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;

/**
* CarrierAbstract
* @codeCoverageIgnore
*/
abstract class CarrierAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?bool
     */
    protected $externallyRated = false;

    /**
     * @var ?float
     */
    protected $balance = 0;

    /**
     * @var ?bool
     */
    protected $calculateCost = false;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var ?TransformationRuleSetInterface
     */
    protected $transformationRuleSet = null;

    /**
     * @var ?CurrencyInterface
     */
    protected $currency = null;

    /**
     * @var ?ProxyTrunkInterface
     */
    protected $proxyTrunk = null;

    /**
     * @var ?MediaRelaySetInterface
     */
    protected $mediaRelaySets = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $description,
        string $name
    ) {
        $this->setDescription($description);
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Carrier",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CarrierDto
    {
        return new CarrierDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CarrierInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CarrierDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CarrierInterface::class);

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
     * @param CarrierDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CarrierDto::class);
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
            $description,
            $name
        );

        $self
            ->setExternallyRated($dto->getExternallyRated())
            ->setBalance($dto->getBalance())
            ->setCalculateCost($dto->getCalculateCost())
            ->setBrand($fkTransformer->transform($brand))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CarrierDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CarrierDto::class);

        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setDescription($description)
            ->setName($name)
            ->setExternallyRated($dto->getExternallyRated())
            ->setBalance($dto->getBalance())
            ->setCalculateCost($dto->getCalculateCost())
            ->setBrand($fkTransformer->transform($brand))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CarrierDto
    {
        return self::createDto()
            ->setDescription(self::getDescription())
            ->setName(self::getName())
            ->setExternallyRated(self::getExternallyRated())
            ->setBalance(self::getBalance())
            ->setCalculateCost(self::getCalculateCost())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setCurrency(Currency::entityToDto(self::getCurrency(), $depth))
            ->setProxyTrunk(ProxyTrunk::entityToDto(self::getProxyTrunk(), $depth))
            ->setMediaRelaySets(MediaRelaySet::entityToDto(self::getMediaRelaySets(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'description' => self::getDescription(),
            'name' => self::getName(),
            'externallyRated' => self::getExternallyRated(),
            'balance' => self::getBalance(),
            'calculateCost' => self::getCalculateCost(),
            'brandId' => self::getBrand()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet()?->getId(),
            'currencyId' => self::getCurrency()?->getId(),
            'proxyTrunkId' => self::getProxyTrunk()?->getId(),
            'mediaRelaySetsId' => self::getMediaRelaySets()?->getId()
        ];
    }

    protected function setDescription(string $description): static
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 200, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setExternallyRated(?bool $externallyRated = null): static
    {
        $this->externallyRated = $externallyRated;

        return $this;
    }

    public function getExternallyRated(): ?bool
    {
        return $this->externallyRated;
    }

    protected function setBalance(?float $balance = null): static
    {
        if (!is_null($balance)) {
            $balance = (float) $balance;
        }

        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    protected function setCalculateCost(?bool $calculateCost = null): static
    {
        $this->calculateCost = $calculateCost;

        return $this;
    }

    public function getCalculateCost(): ?bool
    {
        return $this->calculateCost;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    protected function setCurrency(?CurrencyInterface $currency = null): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

    protected function setProxyTrunk(?ProxyTrunkInterface $proxyTrunk = null): static
    {
        $this->proxyTrunk = $proxyTrunk;

        return $this;
    }

    public function getProxyTrunk(): ?ProxyTrunkInterface
    {
        return $this->proxyTrunk;
    }

    protected function setMediaRelaySets(?MediaRelaySetInterface $mediaRelaySets = null): static
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    public function getMediaRelaySets(): ?MediaRelaySetInterface
    {
        return $this->mediaRelaySets;
    }
}
