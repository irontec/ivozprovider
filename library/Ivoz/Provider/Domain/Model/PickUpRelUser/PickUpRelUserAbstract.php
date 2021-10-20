<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var PickUpGroupInterface | null
     * inversedBy relUsers
     */
    protected $pickUpGroup;

    /**
     * @var UserInterface | null
     * inversedBy pickUpRelUsers
     */
    protected $user;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "PickUpRelUser",
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
    public static function createDto($id = null): PickUpRelUserDto
    {
        return new PickUpRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param PickUpRelUserInterface|null $entity
     * @param int $depth
     * @return PickUpRelUserDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var PickUpRelUserDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PickUpRelUserDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, PickUpRelUserDto::class);

        $this
            ->setPickUpGroup($fkTransformer->transform($dto->getPickUpGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): PickUpRelUserDto
    {
        return self::createDto()
            ->setPickUpGroup(PickUpGroup::entityToDto(self::getPickUpGroup(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'pickUpGroupId' => self::getPickUpGroup() ? self::getPickUpGroup()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null
        ];
    }

    public function setPickUpGroup(?PickUpGroupInterface $pickUpGroup = null): static
    {
        $this->pickUpGroup = $pickUpGroup;

        /** @var  $this */
        return $this;
    }

    public function getPickUpGroup(): ?PickUpGroupInterface
    {
        return $this->pickUpGroup;
    }

    public function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        /** @var  $this */
        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}
