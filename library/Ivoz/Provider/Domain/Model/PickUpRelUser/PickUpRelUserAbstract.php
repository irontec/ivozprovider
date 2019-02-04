<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * PickUpRelUserAbstract
 * @codeCoverageIgnore
 */
abstract class PickUpRelUserAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface
     */
    protected $pickUpGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;


    use ChangelogTrait;

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
     * @param null $id
     * @return PickUpRelUserDto
     */
    public static function createDto($id = null)
    {
        return new PickUpRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto PickUpRelUserDto
         */
        Assertion::isInstanceOf($dto, PickUpRelUserDto::class);

        $self = new static();

        $self
            ->setPickUpGroup($fkTransformer->transform($dto->getPickUpGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto PickUpRelUserDto
         */
        Assertion::isInstanceOf($dto, PickUpRelUserDto::class);

        $this
            ->setPickUpGroup($fkTransformer->transform($dto->getPickUpGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()));



        $this->sanitizeValues();
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
            ->setPickUpGroup(\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroup::entityToDto(self::getPickUpGroup(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set pickUpGroup
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface $pickUpGroup
     *
     * @return self
     */
    public function setPickUpGroup(\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface $pickUpGroup = null)
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    /**
     * Get pickUpGroup
     *
     * @return \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface
     */
    public function getPickUpGroup()
    {
        return $this->pickUpGroup;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    // @codeCoverageIgnoreEnd
}
