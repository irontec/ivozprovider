<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FeaturesRelBrandAbstract
 * @codeCoverageIgnore
 */
abstract class FeaturesRelBrandAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    protected $feature;


    use ChangelogTrait;

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
     * @param null $id
     * @return FeaturesRelBrandDto
     */
    public static function createDto($id = null)
    {
        return new FeaturesRelBrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
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
         * @var $dto FeaturesRelBrandDto
         */
        Assertion::isInstanceOf($dto, FeaturesRelBrandDto::class);

        $self = new static();

        $self
            ->setBrand($dto->getBrand())
            ->setFeature($dto->getFeature())
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
         * @var $dto FeaturesRelBrandDto
         */
        Assertion::isInstanceOf($dto, FeaturesRelBrandDto::class);

        $this
            ->setBrand($dto->getBrand())
            ->setFeature($dto->getFeature());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FeaturesRelBrandDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setFeature(\Ivoz\Provider\Domain\Model\Feature\Feature::entityToDto(self::getFeature(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'featureId' => self::getFeature() ? self::getFeature()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

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
     * Set feature
     *
     * @param \Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature
     *
     * @return self
     */
    public function setFeature(\Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    public function getFeature()
    {
        return $this->feature;
    }

    // @codeCoverageIgnoreEnd
}
