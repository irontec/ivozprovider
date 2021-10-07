<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;

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
     * @var TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

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
     * @param mixed $id
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
        $dto = $entity->toDto($depth - 1);

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
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()));

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
            ->setProxyTrunk($fkTransformer->transform($dto->getProxyTrunk()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()));

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
            'brandId' => self::getBrand()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
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
