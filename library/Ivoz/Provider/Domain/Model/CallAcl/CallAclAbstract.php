<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* CallAclAbstract
* @codeCoverageIgnore
*/
abstract class CallAclAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     * comment: enum:allow|deny
     */
    protected $defaultPolicy;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $defaultPolicy
    ) {
        $this->setName($name);
        $this->setDefaultPolicy($defaultPolicy);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CallAcl",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CallAclDto
    {
        return new CallAclDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CallAclInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallAclDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallAclInterface::class);

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
     * @param CallAclDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallAclDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $defaultPolicy = $dto->getDefaultPolicy();
        Assertion::notNull($defaultPolicy, 'getDefaultPolicy value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $defaultPolicy
        );

        $self
            ->setCompany($fkTransformer->transform($company));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallAclDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallAclDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $defaultPolicy = $dto->getDefaultPolicy();
        Assertion::notNull($defaultPolicy, 'getDefaultPolicy value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDefaultPolicy($defaultPolicy)
            ->setCompany($fkTransformer->transform($company));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallAclDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDefaultPolicy(self::getDefaultPolicy())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'defaultPolicy' => self::getDefaultPolicy(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDefaultPolicy(string $defaultPolicy): static
    {
        Assertion::maxLength($defaultPolicy, 10, 'defaultPolicy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $defaultPolicy,
            [
                CallAclInterface::DEFAULTPOLICY_ALLOW,
                CallAclInterface::DEFAULTPOLICY_DENY,
            ],
            'defaultPolicyvalue "%s" is not an element of the valid values: %s'
        );

        $this->defaultPolicy = $defaultPolicy;

        return $this;
    }

    public function getDefaultPolicy(): string
    {
        return $this->defaultPolicy;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }
}
