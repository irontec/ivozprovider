<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @param mixed $id
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
        $dto = $entity->toDto($depth - 1);

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

    protected function setCreate(bool $create): static
    {
        Assertion::between(intval($create), 0, 1, 'create provided "%s" is not a valid boolean value.');
        $create = (bool) $create;

        $this->create = $create;

        return $this;
    }

    public function getCreate(): bool
    {
        return $this->create;
    }

    protected function setRead(bool $read): static
    {
        Assertion::between(intval($read), 0, 1, 'read provided "%s" is not a valid boolean value.');
        $read = (bool) $read;

        $this->read = $read;

        return $this;
    }

    public function getRead(): bool
    {
        return $this->read;
    }

    protected function setUpdate(bool $update): static
    {
        Assertion::between(intval($update), 0, 1, 'update provided "%s" is not a valid boolean value.');
        $update = (bool) $update;

        $this->update = $update;

        return $this;
    }

    public function getUpdate(): bool
    {
        return $this->update;
    }

    protected function setDelete(bool $delete): static
    {
        Assertion::between(intval($delete), 0, 1, 'delete provided "%s" is not a valid boolean value.');
        $delete = (bool) $delete;

        $this->delete = $delete;

        return $this;
    }

    public function getDelete(): bool
    {
        return $this->delete;
    }

    public function setAdministrator(AdministratorInterface $administrator): static
    {
        $this->administrator = $administrator;

        /** @var  $this */
        return $this;
    }

    public function getAdministrator(): AdministratorInterface
    {
        return $this->administrator;
    }

    protected function setPublicEntity(PublicEntityInterface $publicEntity): static
    {
        $this->publicEntity = $publicEntity;

        return $this;
    }

    public function getPublicEntity(): PublicEntityInterface
    {
        return $this->publicEntity;
    }
}
