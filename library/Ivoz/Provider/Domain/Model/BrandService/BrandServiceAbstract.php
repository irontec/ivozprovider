<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\BrandService;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Service\Service;

/**
* BrandServiceAbstract
* @codeCoverageIgnore
*/
abstract class BrandServiceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var BrandInterface
     * inversedBy services
     */
    protected $brand;

    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * Constructor
     */
    protected function __construct(
        $code
    ) {
        $this->setCode($code);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "BrandService",
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
     * @return BrandServiceDto
     */
    public static function createDto($id = null)
    {
        return new BrandServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BrandServiceInterface|null $entity
     * @param int $depth
     * @return BrandServiceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BrandServiceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var BrandServiceDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BrandServiceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BrandServiceDto::class);

        $self = new static(
            $dto->getCode()
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setService($fkTransformer->transform($dto->getService()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BrandServiceDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BrandServiceDto::class);

        $this
            ->setCode($dto->getCode())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setService($fkTransformer->transform($dto->getService()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return BrandServiceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCode(self::getCode())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setService(Service::entityToDto(self::getService(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'code' => self::getCode(),
            'brandId' => self::getBrand()->getId(),
            'serviceId' => self::getService()->getId()
        ];
    }

    protected function setCode(string $code): static
    {
        Assertion::maxLength($code, 3, 'code value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->code = $code;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        /** @var  $this */
        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setService(ServiceInterface $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getService(): ServiceInterface
    {
        return $this->service;
    }
}
