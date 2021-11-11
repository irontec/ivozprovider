<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;

/**
* CompanyRelRoutingTagAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelRoutingTagAbstract
{
    use ChangelogTrait;

    /**
     * @var ?CompanyInterface
     * inversedBy relRoutingTags
     */
    protected $company = null;

    /**
     * @var RoutingTagInterface
     * inversedBy relCompanies
     */
    protected $routingTag;

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
            "CompanyRelRoutingTag",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CompanyRelRoutingTagDto
    {
        return new CompanyRelRoutingTagDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CompanyRelRoutingTagInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyRelRoutingTagDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyRelRoutingTagInterface::class);

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
     * @param CompanyRelRoutingTagDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyRelRoutingTagDto::class);

        $self = new static();

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelRoutingTagDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyRelRoutingTagDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyRelRoutingTagDto
    {
        return self::createDto()
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setRoutingTag(RoutingTag::entityToDto(self::getRoutingTag(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'companyId' => self::getCompany()?->getId(),
            'routingTagId' => self::getRoutingTag()->getId()
        ];
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    public function setRoutingTag(RoutingTagInterface $routingTag): static
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    public function getRoutingTag(): RoutingTagInterface
    {
        return $this->routingTag;
    }
}
