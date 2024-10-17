<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;

/**
* ApplicationServerSetsRelBrandAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerSetsRelBrandAbstract
{
    use ChangelogTrait;

    /**
     * @var ?BrandInterface
     * inversedBy relApplicationServerSets
     */
    protected $brand = null;

    /**
     * @var ApplicationServerSetInterface
     */
    protected $applicationServerSet;

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
            "ApplicationServerSetsRelBrand",
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
    public static function createDto($id = null): ApplicationServerSetsRelBrandDto
    {
        return new ApplicationServerSetsRelBrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerSetsRelBrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerSetsRelBrandDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ApplicationServerSetsRelBrandInterface::class);

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
     * @param ApplicationServerSetsRelBrandDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerSetsRelBrandDto::class);
        $applicationServerSet = $dto->getApplicationServerSet();
        Assertion::notNull($applicationServerSet, 'getApplicationServerSet value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setApplicationServerSet($fkTransformer->transform($applicationServerSet));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ApplicationServerSetsRelBrandDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerSetsRelBrandDto::class);

        $applicationServerSet = $dto->getApplicationServerSet();
        Assertion::notNull($applicationServerSet, 'getApplicationServerSet value is null, but non null value was expected.');

        $this
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setApplicationServerSet($fkTransformer->transform($applicationServerSet));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetsRelBrandDto
    {
        return self::createDto()
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setApplicationServerSet(ApplicationServerSet::entityToDto(self::getApplicationServerSet(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'brandId' => self::getBrand()?->getId(),
            'applicationServerSetId' => self::getApplicationServerSet()->getId()
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

    protected function setApplicationServerSet(ApplicationServerSetInterface $applicationServerSet): static
    {
        $this->applicationServerSet = $applicationServerSet;

        return $this;
    }

    public function getApplicationServerSet(): ApplicationServerSetInterface
    {
        return $this->applicationServerSet;
    }
}
