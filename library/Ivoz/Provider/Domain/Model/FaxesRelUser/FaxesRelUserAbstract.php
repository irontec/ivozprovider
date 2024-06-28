<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\FaxesRelUser;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Fax\Fax;

/**
* FaxesRelUserAbstract
* @codeCoverageIgnore
*/
abstract class FaxesRelUserAbstract
{
    use ChangelogTrait;

    /**
     * @var UserInterface
     * inversedBy faxesRelUsers
     */
    protected $user;

    /**
     * @var ?FaxInterface
     * inversedBy faxesRelUsers
     */
    protected $fax = null;

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
            "FaxesRelUser",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): FaxesRelUserDto
    {
        return new FaxesRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|FaxesRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FaxesRelUserDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FaxesRelUserInterface::class);

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
     * @param FaxesRelUserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FaxesRelUserDto::class);
        $user = $dto->getUser();
        Assertion::notNull($user, 'getUser value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setUser($fkTransformer->transform($user))
            ->setFax($fkTransformer->transform($dto->getFax()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FaxesRelUserDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FaxesRelUserDto::class);

        $user = $dto->getUser();
        Assertion::notNull($user, 'getUser value is null, but non null value was expected.');

        $this
            ->setUser($fkTransformer->transform($user))
            ->setFax($fkTransformer->transform($dto->getFax()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FaxesRelUserDto
    {
        return self::createDto()
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFax(Fax::entityToDto(self::getFax(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'userId' => self::getUser()->getId(),
            'faxId' => self::getFax()?->getId()
        ];
    }

    public function setUser(UserInterface $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setFax(?FaxInterface $fax = null): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getFax(): ?FaxInterface
    {
        return $this->fax;
    }
}
