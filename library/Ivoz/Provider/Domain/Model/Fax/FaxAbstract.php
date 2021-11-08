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

    protected $name;

    protected $email;

    protected $sendByEmail = true;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var DdiInterface | null
     */
    protected $outgoingDdi;

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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Fax",
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
     */
    public static function createDto($id = null): FaxDto
    {
        return new FaxDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FaxInterface|null $entity
     * @param int $depth
     * @return FaxDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var FaxDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     */
    public function toDto($depth = 0): FaxDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setEmail(self::getEmail())
            ->setSendByEmail(self::getSendByEmail())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'email' => self::getEmail(),
            'sendByEmail' => self::getSendByEmail(),
            'companyId' => self::getCompany()->getId(),
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null
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
