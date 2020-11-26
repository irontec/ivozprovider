<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var PickUpGroupInterface
     * inversedBy relUsers
     */
    protected $pickUpGroup;

    /**
     * @var UserInterface
     * inversedBy pickUpRelUsers
     */
    protected $user;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

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
     * @param null $id
     * @return PickUpRelUserDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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

        $self = new static(

        );

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
     * @return PickUpRelUserDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set pickUpGroup
     *
     * @param PickUpGroupInterface | null
     *
     * @return static
     */
    public function setPickUpGroup(?PickUpGroupInterface $pickUpGroup = null): PickUpRelUserInterface
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    /**
     * Get pickUpGroup
     *
     * @return PickUpGroupInterface | null
     */
    public function getPickUpGroup(): ?PickUpGroupInterface
    {
        return $this->pickUpGroup;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    public function setUser(?UserInterface $user = null): PickUpRelUserInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

}
