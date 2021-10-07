<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Carrier;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var bool | null
     */
    protected $externallyRated = false;

    /**
     * @var float | null
     */
    protected $balance = 0;

    /**
     * @var bool | null
     */
    protected $calculateCost = false;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var CurrencyInterface | null
     */
    protected $currency;

    /**
     * @var ProxyTrunkInterface | null
     */
    protected $proxyTrunk;

    /**
     * @var MediaRelaySetInterface | null
     */
    protected $mediaRelaySets;

    /**
     * Constructor
     */
    protected function __construct(
        $description,
        $name
    ) {
        $this->setDescription($description);
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Carrier",
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
     * @return CarrierDto
     */
    public static function createDto($id = null)
    {
        return new CarrierDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CarrierInterface|null $entity
     * @param int $depth
     * @return CarrierDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CarrierDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CarrierDto::class);

        $self = new static(
            $dto->getDescription(),
            $dto->getName()
        );

        $self
            ->setExternallyRated($dto->getExternallyRated())
            ->setBalance($dto->getBalance())
            ->setCalculateCost($dto->getCalculateCost())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CarrierDto::class);

        $this
            ->setDescription($dto->getDescription())
            ->setName($dto->getName())
            ->setExternallyRated($dto->getExternallyRated())
            ->setBalance($dto->getBalance())
            ->setCalculateCost($dto->getCalculateCost())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CarrierDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
    {
        return [
            'description' => self::getDescription(),
            'name' => self::getName(),
            'externallyRated' => self::getExternallyRated(),
            'balance' => self::getBalance(),
            'calculateCost' => self::getCalculateCost(),
            'brandId' => self::getBrand()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'currencyId' => self::getCurrency() ? self::getCurrency()->getId() : null,
            'proxyTrunkId' => self::getProxyTrunk() ? self::getProxyTrunk()->getId() : null,
            'mediaRelaySetsId' => self::getMediaRelaySets() ? self::getMediaRelaySets()->getId() : null
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
        if (!is_null($externallyRated)) {
            Assertion::between(intval($externallyRated), 0, 1, 'externallyRated provided "%s" is not a valid boolean value.');
            $externallyRated = (bool) $externallyRated;
        }

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
        if (!is_null($calculateCost)) {
            Assertion::between(intval($calculateCost), 0, 1, 'calculateCost provided "%s" is not a valid boolean value.');
            $calculateCost = (bool) $calculateCost;
        }

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
