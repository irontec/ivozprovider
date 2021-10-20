<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Feature\Feature;

/**
* FeaturesRelBrandAbstract
* @codeCoverageIgnore
*/
abstract class FeaturesRelBrandAbstract
{
    use ChangelogTrait;

    /**
     * @var BrandInterface | null
     * inversedBy relFeatures
     */
    protected $brand;

    /**
     * @var FeatureInterface
     */
    protected $feature;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "FeaturesRelBrand",
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
     */
    public static function createDto($id = null): FeaturesRelBrandDto
    {
        return new FeaturesRelBrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FeaturesRelBrandInterface|null $entity
     * @param int $depth
     * @return FeaturesRelBrandDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FeaturesRelBrandInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FeaturesRelBrandDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FeaturesRelBrandDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FeaturesRelBrandDto::class);

        $self = new static();

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setFeature($fkTransformer->transform($dto->getFeature()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FeaturesRelBrandDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FeaturesRelBrandDto::class);

        $this
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setFeature($fkTransformer->transform($dto->getFeature()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): FeaturesRelBrandDto
    {
        return self::createDto()
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setFeature(Feature::entityToDto(self::getFeature(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'featureId' => self::getFeature()->getId()
        ];
    }

    public function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        /** @var  $this */
        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setFeature(FeatureInterface $feature): static
    {
        $this->feature = $feature;

        return $this;
    }

    public function getFeature(): FeatureInterface
    {
        return $this->feature;
    }
}
