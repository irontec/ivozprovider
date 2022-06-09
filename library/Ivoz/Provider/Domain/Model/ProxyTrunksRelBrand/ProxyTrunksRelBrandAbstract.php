<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

/**
* ProxyTrunksRelBrandAbstract
* @codeCoverageIgnore
*/
abstract class ProxyTrunksRelBrandAbstract
{
    use ChangelogTrait;

    /**
     * @var ?BrandInterface
     * inversedBy relProxyTrunks
     */
    protected $brand = null;

    /**
     * @var ProxyTrunkInterface
     */
    protected $proxyTrunk;

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
            "ProxyTrunksRelBrand",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ProxyTrunksRelBrandDto
    {
        return new ProxyTrunksRelBrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ProxyTrunksRelBrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ProxyTrunksRelBrandDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ProxyTrunksRelBrandInterface::class);

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
     * @param ProxyTrunksRelBrandDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ProxyTrunksRelBrandDto::class);
        $proxyTrunk = $dto->getProxyTrunk();
        Assertion::notNull($proxyTrunk, 'getProxyTrunk value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setProxyTrunk($fkTransformer->transform($proxyTrunk));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ProxyTrunksRelBrandDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ProxyTrunksRelBrandDto::class);

        $proxyTrunk = $dto->getProxyTrunk();
        Assertion::notNull($proxyTrunk, 'getProxyTrunk value is null, but non null value was expected.');

        $this
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setProxyTrunk($fkTransformer->transform($proxyTrunk));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ProxyTrunksRelBrandDto
    {
        return self::createDto()
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setProxyTrunk(ProxyTrunk::entityToDto(self::getProxyTrunk(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'brandId' => self::getBrand()?->getId(),
            'proxyTrunkId' => self::getProxyTrunk()->getId()
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

    protected function setProxyTrunk(ProxyTrunkInterface $proxyTrunk): static
    {
        $this->proxyTrunk = $proxyTrunk;

        return $this;
    }

    public function getProxyTrunk(): ProxyTrunkInterface
    {
        return $this->proxyTrunk;
    }
}
