<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Fax;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

/**
* FaxAbstract
* @codeCoverageIgnore
*/
abstract class FaxAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     */
    protected $email = null;

    /**
     * @var bool
     */
    protected $sendByEmail = true;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var ?DdiInterface
     */
    protected $outgoingDdi = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        bool $sendByEmail
    ) {
        $this->setName($name);
        $this->setSendByEmail($sendByEmail);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Fax",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): FaxDto
    {
        return new FaxDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|FaxInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FaxDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FaxInterface::class);

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
     * @param FaxDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FaxDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getSendByEmail()
        );

        $self
            ->setEmail($dto->getEmail())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FaxDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FaxDto::class);

        $this
            ->setName($dto->getName())
            ->setEmail($dto->getEmail())
            ->setSendByEmail($dto->getSendByEmail())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FaxDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setEmail(self::getEmail())
            ->setSendByEmail(self::getSendByEmail())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'email' => self::getEmail(),
            'sendByEmail' => self::getSendByEmail(),
            'companyId' => self::getCompany()->getId(),
            'outgoingDdiId' => self::getOutgoingDdi()?->getId()
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

    protected function setEmail(?string $email = null): static
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 255, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    protected function setSendByEmail(bool $sendByEmail): static
    {
        $this->sendByEmail = $sendByEmail;

        return $this;
    }

    public function getSendByEmail(): bool
    {
        return $this->sendByEmail;
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

    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): static
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    public function getOutgoingDdi(): ?DdiInterface
    {
        return $this->outgoingDdi;
    }
}
