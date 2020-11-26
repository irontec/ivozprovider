<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

/**
* DdiProviderAbstract
* @codeCoverageIgnore
*/
abstract class DdiProviderAbstract
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
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

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
            "DdiProvider",
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
     * @return DdiProviderDto
     */
    public static function createDto($id = null)
    {
        return new DdiProviderDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderInterface|null $entity
     * @param int $depth
     * @return DdiProviderDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DdiProviderInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var DdiProviderDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiProviderDto::class);

        $self = new static(
            $dto->getDescription(),
            $dto->getName()
        );

        $self
            ->setExternallyRated($dto->getExternallyRated())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiProviderDto::class);

        $this
            ->setDescription($dto->getDescription())
            ->setName($dto->getName())
            ->setExternallyRated($dto->getExternallyRated())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DdiProviderDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDescription(self::getDescription())
            ->setName(self::getName())
            ->setExternallyRated(self::getExternallyRated())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
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
            'brandId' => self::getBrand()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
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
    protected function setDescription(string $description): DdiProviderInterface
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
    protected function setName(string $name): DdiProviderInterface
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
    protected function setExternallyRated(?bool $externallyRated = null): DdiProviderInterface
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
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): DdiProviderInterface
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
    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): DdiProviderInterface
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
     * Set proxyTrunk
     *
     * @param ProxyTrunkInterface | null
     *
     * @return static
     */
    protected function setProxyTrunk(?ProxyTrunkInterface $proxyTrunk = null): DdiProviderInterface
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
