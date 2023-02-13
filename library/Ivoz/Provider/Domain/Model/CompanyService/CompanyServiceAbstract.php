<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
        string $code
    ) {
        $this->setCode($code);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CompanyService",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CompanyServiceDto
    {
        return new CompanyServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CompanyServiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyServiceDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);
        $code = $dto->getCode();
        Assertion::notNull($code, 'getCode value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');
        $service = $dto->getService();
        Assertion::notNull($service, 'getService value is null, but non null value was expected.');

        $self = new static(
            $code
        );

        $self
            ->setCompany($fkTransformer->transform($company))
            ->setService($fkTransformer->transform($service));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $code = $dto->getCode();
        Assertion::notNull($code, 'getCode value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');
        $service = $dto->getService();
        Assertion::notNull($service, 'getService value is null, but non null value was expected.');

        $this
            ->setCode($code)
            ->setCompany($fkTransformer->transform($company))
            ->setService($fkTransformer->transform($service));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyServiceDto
    {
        return self::createDto()
            ->setCode(self::getCode())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setService(Service::entityToDto(self::getService(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
