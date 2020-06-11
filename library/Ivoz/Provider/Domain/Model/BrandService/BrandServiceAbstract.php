<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BrandServiceAbstract
 * @codeCoverageIgnore
 */
abstract class BrandServiceAbstract
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Service\ServiceInterface
     */
    protected $service;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($code)
    {
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
     * @param null $id
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BrandServiceDto::class);

        $self = new static(
            $dto->getCode()
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setService($fkTransformer->transform($dto->getService()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setService(\Ivoz\Provider\Domain\Model\Service\Service::entityToDto(self::getService(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set code
     *
     * @param string $code
     *
     * @return static
     */
    protected function setCode($code)
    {
        Assertion::notNull($code, 'code value "%s" is null, but non null value was expected.');
        Assertion::maxLength($code, 3, 'code value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
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
     * Set service
     *
     * @param \Ivoz\Provider\Domain\Model\Service\ServiceInterface $service
     *
     * @return static
     */
    protected function setService(\Ivoz\Provider\Domain\Model\Service\ServiceInterface $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Ivoz\Provider\Domain\Model\Service\ServiceInterface
     */
    public function getService()
    {
        return $this->service;
    }

    // @codeCoverageIgnoreEnd
}
