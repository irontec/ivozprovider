<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntity;

/**
* AdministratorRelPublicEntityAbstract
* @codeCoverageIgnore
*/
abstract class AdministratorRelPublicEntityAbstract
{
    use ChangelogTrait;

    /**
     * @var bool
     */
    protected $create = false;

    /**
     * @var bool
     */
    protected $read = true;

    /**
     * @var bool
     */
    protected $update = false;

    /**
     * @var bool
     */
    protected $delete = false;

    /**
     * @var AdministratorInterface
     * inversedBy relPublicEntities
     */
    protected $administrator;

    /**
     * @var PublicEntityInterface
     */
    protected $publicEntity;

    /**
     * Constructor
     */
    protected function __construct(
        $create,
        $read,
        $update,
        $delete
    ) {
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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setPublicEntity($fkTransformer->transform($dto->getPublicEntity()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setAdministrator(Administrator::entityToDto(self::getAdministrator(), $depth))
            ->setPublicEntity(PublicEntity::entityToDto(self::getPublicEntity(), $depth));
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

    /**
     * Set create
     *
     * @param bool $create
     *
     * @return static
     */
    protected function setCreate(bool $create): AdministratorRelPublicEntityInterface
    {
        Assertion::between(intval($create), 0, 1, 'create provided "%s" is not a valid boolean value.');
        $create = (bool) $create;

        $this->create = $create;

        return $this;
    }

    /**
     * Get create
     *
     * @return bool
     */
    public function getCreate(): bool
    {
        return $this->create;
    }

    /**
     * Set read
     *
     * @param bool $read
     *
     * @return static
     */
    protected function setRead(bool $read): AdministratorRelPublicEntityInterface
    {
        Assertion::between(intval($read), 0, 1, 'read provided "%s" is not a valid boolean value.');
        $read = (bool) $read;

        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return bool
     */
    public function getRead(): bool
    {
        return $this->read;
    }

    /**
     * Set update
     *
     * @param bool $update
     *
     * @return static
     */
    protected function setUpdate(bool $update): AdministratorRelPublicEntityInterface
    {
        Assertion::between(intval($update), 0, 1, 'update provided "%s" is not a valid boolean value.');
        $update = (bool) $update;

        $this->update = $update;

        return $this;
    }

    /**
     * Get update
     *
     * @return bool
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    /**
     * Set delete
     *
     * @param bool $delete
     *
     * @return static
     */
    protected function setDelete(bool $delete): AdministratorRelPublicEntityInterface
    {
        Assertion::between(intval($delete), 0, 1, 'delete provided "%s" is not a valid boolean value.');
        $delete = (bool) $delete;

        $this->delete = $delete;

        return $this;
    }

    /**
     * Get delete
     *
     * @return bool
     */
    public function getDelete(): bool
    {
        return $this->delete;
    }

    /**
     * Set administrator
     *
     * @param AdministratorInterface
     *
     * @return static
     */
    public function setAdministrator(AdministratorInterface $administrator): AdministratorRelPublicEntityInterface
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * Get administrator
     *
     * @return AdministratorInterface
     */
    public function getAdministrator(): AdministratorInterface
    {
        return $this->administrator;
    }

    /**
     * Set publicEntity
     *
     * @param PublicEntityInterface
     *
     * @return static
     */
    protected function setPublicEntity(PublicEntityInterface $publicEntity): AdministratorRelPublicEntityInterface
    {
        $this->publicEntity = $publicEntity;

        return $this;
    }

    /**
     * Get publicEntity
     *
     * @return PublicEntityInterface
     */
    public function getPublicEntity(): PublicEntityInterface
    {
        return $this->publicEntity;
    }

}
