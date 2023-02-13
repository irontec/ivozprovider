<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorDto;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto;

/**
* AdministratorRelPublicEntityDtoAbstract
* @codeCoverageIgnore
*/
abstract class AdministratorRelPublicEntityDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var bool|null
     */
    private $create = false;

    /**
     * @var bool|null
     */
    private $read = true;

    /**
     * @var bool|null
     */
    private $update = false;

    /**
     * @var bool|null
     */
    private $delete = false;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var AdministratorDto | null
     */
    private $administrator = null;

    /**
     * @var PublicEntityDto | null
     */
    private $publicEntity = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'create' => 'create',
            'read' => 'read',
            'update' => 'update',
            'delete' => 'delete',
            'id' => 'id',
            'administratorId' => 'administrator',
            'publicEntityId' => 'publicEntity'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'create' => $this->getCreate(),
            'read' => $this->getRead(),
            'update' => $this->getUpdate(),
            'delete' => $this->getDelete(),
            'id' => $this->getId(),
            'administrator' => $this->getAdministrator(),
            'publicEntity' => $this->getPublicEntity()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setCreate(bool $create): static
    {
        $this->create = $create;

        return $this;
    }

    public function getCreate(): ?bool
    {
        return $this->create;
    }

    public function setRead(bool $read): static
    {
        $this->read = $read;

        return $this;
    }

    public function getRead(): ?bool
    {
        return $this->read;
    }

    public function setUpdate(bool $update): static
    {
        $this->update = $update;

        return $this;
    }

    public function getUpdate(): ?bool
    {
        return $this->update;
    }

    public function setDelete(bool $delete): static
    {
        $this->delete = $delete;

        return $this;
    }

    public function getDelete(): ?bool
    {
        return $this->delete;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setAdministrator(?AdministratorDto $administrator): static
    {
        $this->administrator = $administrator;

        return $this;
    }

    public function getAdministrator(): ?AdministratorDto
    {
        return $this->administrator;
    }

    public function setAdministratorId($id): static
    {
        $value = !is_null($id)
            ? new AdministratorDto($id)
            : null;

        return $this->setAdministrator($value);
    }

    public function getAdministratorId()
    {
        if ($dto = $this->getAdministrator()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPublicEntity(?PublicEntityDto $publicEntity): static
    {
        $this->publicEntity = $publicEntity;

        return $this;
    }

    public function getPublicEntity(): ?PublicEntityDto
    {
        return $this->publicEntity;
    }

    public function setPublicEntityId($id): static
    {
        $value = !is_null($id)
            ? new PublicEntityDto($id)
            : null;

        return $this->setPublicEntity($value);
    }

    public function getPublicEntityId()
    {
        if ($dto = $this->getPublicEntity()) {
            return $dto->getId();
        }

        return null;
    }
}
