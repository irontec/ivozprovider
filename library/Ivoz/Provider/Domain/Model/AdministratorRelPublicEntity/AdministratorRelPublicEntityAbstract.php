<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * AdministratorRelPublicEntityAbstract
 * @codeCoverageIgnore
 */
abstract class AdministratorRelPublicEntityAbstract
{
    /**
     * @var boolean
     */
    protected $create = false;

    /**
     * @var boolean
     */
    protected $read = true;

    /**
     * @var boolean
     */
    protected $update = false;

    /**
     * @var boolean
     */
    protected $delete = false;

    /**
     * @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface
     */
    protected $administrator;

    /**
     * @var \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface
     */
    protected $publicEntity;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($create, $read, $update, $delete)
    {
        $this->setCreate($create);
        $this->setRead($read);
        $this->setUpdate($update);
        $this->setDelete($delete);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "AdministratorRelPublicEntity",
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
     * @return AdministratorRelPublicEntityDto
     */
    public static function createDto($id = null)
    {
        return new AdministratorRelPublicEntityDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorRelPublicEntityInterface|null $entity
     * @param int $depth
     * @return AdministratorRelPublicEntityDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, AdministratorRelPublicEntityInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var AdministratorRelPublicEntityDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorRelPublicEntityDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, AdministratorRelPublicEntityDto::class);

        $self = new static(
            $dto->getCreate(),
            $dto->getRead(),
            $dto->getUpdate(),
            $dto->getDelete()
        );

        $self
            ->setAdministrator($fkTransformer->transform($dto->getAdministrator()))
            ->setPublicEntity($fkTransformer->transform($dto->getPublicEntity()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorRelPublicEntityDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, AdministratorRelPublicEntityDto::class);

        $this
            ->setCreate($dto->getCreate())
            ->setRead($dto->getRead())
            ->setUpdate($dto->getUpdate())
            ->setDelete($dto->getDelete())
            ->setAdministrator($fkTransformer->transform($dto->getAdministrator()))
            ->setPublicEntity($fkTransformer->transform($dto->getPublicEntity()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return AdministratorRelPublicEntityDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCreate(self::getCreate())
            ->setRead(self::getRead())
            ->setUpdate(self::getUpdate())
            ->setDelete(self::getDelete())
            ->setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\Administrator::entityToDto(self::getAdministrator(), $depth))
            ->setPublicEntity(\Ivoz\Provider\Domain\Model\PublicEntity\PublicEntity::entityToDto(self::getPublicEntity(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'create' => self::getCreate(),
            'read' => self::getRead(),
            'update' => self::getUpdate(),
            'delete' => self::getDelete(),
            'administratorId' => self::getAdministrator()->getId(),
            'publicEntityId' => self::getPublicEntity()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set create
     *
     * @param boolean $create
     *
     * @return static
     */
    protected function setCreate($create)
    {
        Assertion::notNull($create, 'create value "%s" is null, but non null value was expected.');
        Assertion::between(intval($create), 0, 1, 'create provided "%s" is not a valid boolean value.');
        $create = (bool) $create;

        $this->create = $create;

        return $this;
    }

    /**
     * Get create
     *
     * @return boolean
     */
    public function getCreate()
    {
        return $this->create;
    }

    /**
     * Set read
     *
     * @param boolean $read
     *
     * @return static
     */
    protected function setRead($read)
    {
        Assertion::notNull($read, 'read value "%s" is null, but non null value was expected.');
        Assertion::between(intval($read), 0, 1, 'read provided "%s" is not a valid boolean value.');
        $read = (bool) $read;

        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set update
     *
     * @param boolean $update
     *
     * @return static
     */
    protected function setUpdate($update)
    {
        Assertion::notNull($update, 'update value "%s" is null, but non null value was expected.');
        Assertion::between(intval($update), 0, 1, 'update provided "%s" is not a valid boolean value.');
        $update = (bool) $update;

        $this->update = $update;

        return $this;
    }

    /**
     * Get update
     *
     * @return boolean
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Set delete
     *
     * @param boolean $delete
     *
     * @return static
     */
    protected function setDelete($delete)
    {
        Assertion::notNull($delete, 'delete value "%s" is null, but non null value was expected.');
        Assertion::between(intval($delete), 0, 1, 'delete provided "%s" is not a valid boolean value.');
        $delete = (bool) $delete;

        $this->delete = $delete;

        return $this;
    }

    /**
     * Get delete
     *
     * @return boolean
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * Set administrator
     *
     * @param \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator
     *
     * @return static
     */
    public function setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * Get administrator
     *
     * @return \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * Set publicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface $publicEntity
     *
     * @return static
     */
    protected function setPublicEntity(\Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface $publicEntity)
    {
        $this->publicEntity = $publicEntity;

        return $this;
    }

    /**
     * Get publicEntity
     *
     * @return \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface
     */
    public function getPublicEntity()
    {
        return $this->publicEntity;
    }

    // @codeCoverageIgnoreEnd
}
