<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Carrier;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\Currency\Currency;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

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
     * @var TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * @var ProxyTrunkInterface
     */
    protected $proxyTrunk;

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
     * @param null $id
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
        $dto = $entity->toDto($depth-1);

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
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()));

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
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()));

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
            ->setProxyTrunk(ProxyTrunk::entityToDto(self::getProxyTrunk(), $depth));
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
            'proxyTrunkId' => self::getProxyTrunk() ? self::getProxyTrunk()->getId() : null
        ];
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription(string $description): CarrierInterface
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): CarrierInterface
    {
        Assertion::maxLength($name, 200, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set externallyRated
     *
     * @param bool $externallyRated | null
     *
     * @return static
     */
    protected function setExternallyRated(?bool $externallyRated = null): CarrierInterface
    {
        if (!is_null($externallyRated)) {
            Assertion::between(intval($externallyRated), 0, 1, 'externallyRated provided "%s" is not a valid boolean value.');
            $externallyRated = (bool) $externallyRated;
        }

        $this->externallyRated = $externallyRated;

        return $this;
    }

    /**
     * Get externallyRated
     *
     * @return bool | null
     */
    public function getExternallyRated(): ?bool
    {
        return $this->externallyRated;
    }

    /**
     * Set balance
     *
     * @param float $balance | null
     *
     * @return static
     */
    protected function setBalance(?float $balance = null): CarrierInterface
    {
        if (!is_null($balance)) {
            $balance = (float) $balance;
        }

        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * Set calculateCost
     *
     * @param bool $calculateCost | null
     *
     * @return static
     */
    protected function setCalculateCost(?bool $calculateCost = null): CarrierInterface
    {
        if (!is_null($calculateCost)) {
            Assertion::between(intval($calculateCost), 0, 1, 'calculateCost provided "%s" is not a valid boolean value.');
            $calculateCost = (bool) $calculateCost;
        }

        $this->calculateCost = $calculateCost;

        return $this;
    }

    /**
     * Get calculateCost
     *
     * @return bool | null
     */
    public function getCalculateCost(): ?bool
    {
        return $this->calculateCost;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): CarrierInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): CarrierInterface
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set currency
     *
     * @param CurrencyInterface | null
     *
     * @return static
     */
    protected function setCurrency(?CurrencyInterface $currency = null): CarrierInterface
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * Set proxyTrunk
     *
     * @param ProxyTrunkInterface | null
     *
     * @return static
     */
    protected function setProxyTrunk(?ProxyTrunkInterface $proxyTrunk = null): CarrierInterface
    {
        $this->proxyTrunk = $proxyTrunk;

        return $this;
    }

    /**
     * Get proxyTrunk
     *
     * @return ProxyTrunkInterface | null
     */
    public function getProxyTrunk(): ?ProxyTrunkInterface
    {
        return $this->proxyTrunk;
    }

}
