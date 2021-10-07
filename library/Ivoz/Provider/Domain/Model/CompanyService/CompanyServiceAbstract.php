<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Service\Service;

/**
* CompanyServiceAbstract
* @codeCoverageIgnore
*/
abstract class CompanyServiceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var CompanyInterface
     * inversedBy companyServices
     */
    protected $company;

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
            "CompanyService",
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
     * @return CompanyServiceDto
     */
    public static function createDto($id = null)
    {
        return new CompanyServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyServiceInterface|null $entity
     * @param int $depth
     * @return CompanyServiceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyServiceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CompanyServiceDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $self = new static(
            $dto->getCode()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setService($fkTransformer->transform($dto->getService()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $this
            ->setCode($dto->getCode())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setService($fkTransformer->transform($dto->getService()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CompanyServiceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCode(self::getCode())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setService(Service::entityToDto(self::getService(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'code' => self::getCode(),
            'companyId' => self::getCompany()->getId(),
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

    public function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        /** @var  $this */
        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
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
