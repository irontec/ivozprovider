<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Destination;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Destination\Name;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* DestinationAbstract
* @codeCoverageIgnore
*/
abstract class DestinationAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        $prefix,
        Name $name
    ) {
        $this->setPrefix($prefix);
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Destination",
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
     * @return DestinationDto
     */
    public static function createDto($id = null)
    {
        return new DestinationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationInterface|null $entity
     * @param int $depth
     * @return DestinationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DestinationInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var DestinationDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DestinationDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $self = new static(
            $dto->getPrefix(),
            $name
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DestinationDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $this
            ->setPrefix($dto->getPrefix())
            ->setName($name)
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DestinationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPrefix(self::getPrefix())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'prefix' => self::getPrefix(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    protected function setPrefix(string $prefix): static
    {
        Assertion::maxLength($prefix, 24, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    protected function setName(Name $name): static
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
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
}
