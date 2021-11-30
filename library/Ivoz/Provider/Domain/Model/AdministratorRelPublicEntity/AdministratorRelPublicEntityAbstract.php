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
        bool $create,
        bool $read,
        bool $update,
        bool $delete
    ) {
        $this->setCreate($create);
        $this->setRead($read);
        $this->setUpdate($update);
        $this->setDelete($delete);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "AdministratorRelPublicEntity",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): AdministratorRelPublicEntityDto
    {
        return new AdministratorRelPublicEntityDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|AdministratorRelPublicEntityInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?AdministratorRelPublicEntityDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorRelPublicEntityDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, AdministratorRelPublicEntityDto::class);
        $create = $dto->getCreate();
        Assertion::notNull($create, 'getCreate value is null, but non null value was expected.');
        $read = $dto->getRead();
        Assertion::notNull($read, 'getRead value is null, but non null value was expected.');
        $update = $dto->getUpdate();
        Assertion::notNull($update, 'getUpdate value is null, but non null value was expected.');
        $delete = $dto->getDelete();
        Assertion::notNull($delete, 'getDelete value is null, but non null value was expected.');
        $administrator = $dto->getAdministrator();
        Assertion::notNull($administrator, 'getAdministrator value is null, but non null value was expected.');
        $publicEntity = $dto->getPublicEntity();
        Assertion::notNull($publicEntity, 'getPublicEntity value is null, but non null value was expected.');

        $self = new static(
            $create,
            $read,
            $update,
            $delete
        );

        $self
            ->setAdministrator($fkTransformer->transform($administrator))
            ->setPublicEntity($fkTransformer->transform($publicEntity));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorRelPublicEntityDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, AdministratorRelPublicEntityDto::class);

        $create = $dto->getCreate();
        Assertion::notNull($create, 'getCreate value is null, but non null value was expected.');
        $read = $dto->getRead();
        Assertion::notNull($read, 'getRead value is null, but non null value was expected.');
        $update = $dto->getUpdate();
        Assertion::notNull($update, 'getUpdate value is null, but non null value was expected.');
        $delete = $dto->getDelete();
        Assertion::notNull($delete, 'getDelete value is null, but non null value was expected.');
        $administrator = $dto->getAdministrator();
        Assertion::notNull($administrator, 'getAdministrator value is null, but non null value was expected.');
        $publicEntity = $dto->getPublicEntity();
        Assertion::notNull($publicEntity, 'getPublicEntity value is null, but non null value was expected.');

        $this
            ->setCreate($create)
            ->setRead($read)
            ->setUpdate($update)
            ->setDelete($delete)
            ->setAdministrator($fkTransformer->transform($administrator))
            ->setPublicEntity($fkTransformer->transform($publicEntity));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorRelPublicEntityDto
    {
        return self::createDto()
            ->setCreate(self::getCreate())
            ->setRead(self::getRead())
            ->setUpdate(self::getUpdate())
            ->setDelete(self::getDelete())
            ->setAdministrator(Administrator::entityToDto(self::getAdministrator(), $depth))
            ->setPublicEntity(PublicEntity::entityToDto(self::getPublicEntity(), $depth));
    }

    protected function __toArray(): array
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
        $this->create = $create;

        return $this;
    }

    public function getCreate(): bool
    {
        return $this->create;
    }

    protected function setRead(bool $read): static
    {
        $this->read = $read;

        return $this;
    }

    public function getRead(): bool
    {
        return $this->read;
    }

    protected function setUpdate(bool $update): static
    {
        $this->update = $update;

        return $this;
    }

    public function getUpdate(): bool
    {
        return $this->update;
    }

    protected function setDelete(bool $delete): static
    {
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
