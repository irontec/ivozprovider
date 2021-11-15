<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* RoutingTagAbstract
* @codeCoverageIgnore
*/
abstract class RoutingTagAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $tag
    ) {
        $this->setName($name);
        $this->setTag($tag);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "RoutingTag",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): RoutingTagDto
    {
        return new RoutingTagDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|RoutingTagInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RoutingTagDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RoutingTagInterface::class);

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
     * @param RoutingTagDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RoutingTagDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $tag = $dto->getTag();
        Assertion::notNull($tag, 'getTag value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
            $name,
            $tag
        );

        $self
            ->setBrand($fkTransformer->transform($brand));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RoutingTagDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RoutingTagDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $tag = $dto->getTag();
        Assertion::notNull($tag, 'getTag value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setTag($tag)
            ->setBrand($fkTransformer->transform($brand));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingTagDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setTag(self::getTag())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'tag' => self::getTag(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 80, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setTag(string $tag): static
    {
        Assertion::maxLength($tag, 15, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tag = $tag;

        return $this;
    }

    public function getTag(): string
    {
        return $this->tag;
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
