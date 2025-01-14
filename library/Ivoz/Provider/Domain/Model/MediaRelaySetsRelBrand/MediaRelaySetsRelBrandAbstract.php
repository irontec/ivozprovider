<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;

/**
* MediaRelaySetsRelBrandAbstract
* @codeCoverageIgnore
*/
abstract class MediaRelaySetsRelBrandAbstract
{
    use ChangelogTrait;

    /**
     * @var ?BrandInterface
     * inversedBy relMediaRelaySets
     */
    protected $brand = null;

    /**
     * @var MediaRelaySetInterface
     */
    protected $mediaRelaySet;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "MediaRelaySetsRelBrand",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): MediaRelaySetsRelBrandDto
    {
        return new MediaRelaySetsRelBrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|MediaRelaySetsRelBrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MediaRelaySetsRelBrandDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MediaRelaySetsRelBrandInterface::class);

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
     * @param MediaRelaySetsRelBrandDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MediaRelaySetsRelBrandDto::class);
        $mediaRelaySet = $dto->getMediaRelaySet();
        Assertion::notNull($mediaRelaySet, 'getMediaRelaySet value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setMediaRelaySet($fkTransformer->transform($mediaRelaySet));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MediaRelaySetsRelBrandDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MediaRelaySetsRelBrandDto::class);

        $mediaRelaySet = $dto->getMediaRelaySet();
        Assertion::notNull($mediaRelaySet, 'getMediaRelaySet value is null, but non null value was expected.');

        $this
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setMediaRelaySet($fkTransformer->transform($mediaRelaySet));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MediaRelaySetsRelBrandDto
    {
        return self::createDto()
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setMediaRelaySet(MediaRelaySet::entityToDto(self::getMediaRelaySet(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'brandId' => self::getBrand()?->getId(),
            'mediaRelaySetId' => self::getMediaRelaySet()->getId()
        ];
    }

    public function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setMediaRelaySet(MediaRelaySetInterface $mediaRelaySet): static
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    public function getMediaRelaySet(): MediaRelaySetInterface
    {
        return $this->mediaRelaySet;
    }
}
