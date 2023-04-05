<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroup;
use Ivoz\Provider\Domain\Model\User\User;

/**
* PickUpRelUserAbstract
* @codeCoverageIgnore
*/
abstract class PickUpRelUserAbstract
{
    use ChangelogTrait;

    /**
     * @var ?PickUpGroupInterface
     * inversedBy relUsers
     */
    protected $pickUpGroup = null;

    /**
     * @var ?UserInterface
     * inversedBy pickUpRelUsers
     */
    protected $user = null;

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
            "PickUpRelUser",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): PickUpRelUserDto
    {
        return new PickUpRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|PickUpRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PickUpRelUserDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PickUpRelUserInterface::class);

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
     * @param PickUpRelUserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PickUpRelUserDto::class);

        $self = new static();

        $self
            ->setPickUpGroup($fkTransformer->transform($dto->getPickUpGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param PickUpRelUserDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PickUpRelUserDto::class);

        $this
            ->setPickUpGroup($fkTransformer->transform($dto->getPickUpGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PickUpRelUserDto
    {
        return self::createDto()
            ->setPickUpGroup(PickUpGroup::entityToDto(self::getPickUpGroup(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'pickUpGroupId' => self::getPickUpGroup()?->getId(),
            'userId' => self::getUser()?->getId()
        ];
    }

    public function setPickUpGroup(?PickUpGroupInterface $pickUpGroup = null): static
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    public function getPickUpGroup(): ?PickUpGroupInterface
    {
        return $this->pickUpGroup;
    }

    public function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}
