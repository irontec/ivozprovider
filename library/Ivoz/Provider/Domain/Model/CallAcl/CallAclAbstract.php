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
     * comment: enum:allow|deny
     * @var string
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
        $name,
        $defaultPolicy
    ) {
        $this->setName($name);
        $this->setDefaultPolicy($defaultPolicy);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CallAcl",
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
     * @return CallAclDto
     */
    public static function createDto($id = null)
    {
        return new CallAclDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CallAclInterface|null $entity
     * @param int $depth
     * @return CallAclDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CallAclDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallAclDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallAclDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDefaultPolicy()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallAclDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallAclDto::class);

        $this
            ->setName($dto->getName())
            ->setDefaultPolicy($dto->getDefaultPolicy())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CallAclDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDefaultPolicy(self::getDefaultPolicy())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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
