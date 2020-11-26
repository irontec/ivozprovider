<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
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
     * @var bool
     */
    private $create = false;

    /**
     * @var bool
     */
    private $read = true;

    /**
     * @var bool
     */
    private $update = false;

    /**
     * @var bool
     */
    private $delete = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var AdministratorDto | null
     */
    private $administrator;

    /**
     * @var PublicEntityDto | null
     */
    private $publicEntity;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param bool $create | null
     *
     * @return static
     */
    public function setCreate(?bool $create = null): self
    {
        $this->create = $create;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getCreate(): ?bool
    {
        return $this->create;
    }

    /**
     * @param bool $read | null
     *
     * @return static
     */
    public function setRead(?bool $read = null): self
    {
        $this->read = $read;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getRead(): ?bool
    {
        return $this->read;
    }

    /**
     * @param bool $update | null
     *
     * @return static
     */
    public function setUpdate(?bool $update = null): self
    {
        $this->update = $update;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getUpdate(): ?bool
    {
        return $this->update;
    }

    /**
     * @param bool $delete | null
     *
     * @return static
     */
    public function setDelete(?bool $delete = null): self
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getDelete(): ?bool
    {
        return $this->delete;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param AdministratorDto | null
     *
     * @return static
     */
    public function setAdministrator(?AdministratorDto $administrator = null): self
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * @return AdministratorDto | null
     */
    public function getAdministrator(): ?AdministratorDto
    {
        return $this->administrator;
    }

    /**
     * @return static
     */
    public function setAdministratorId($id): self
    {
        $value = !is_null($id)
            ? new AdministratorDto($id)
            : null;

        return $this->setAdministrator($value);
    }

    /**
     * @return mixed | null
     */
    public function getAdministratorId()
    {
        if ($dto = $this->getAdministrator()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param PublicEntityDto | null
     *
     * @return static
     */
    public function setPublicEntity(?PublicEntityDto $publicEntity = null): self
    {
        $this->publicEntity = $publicEntity;

        return $this;
    }

    /**
     * @return PublicEntityDto | null
     */
    public function getPublicEntity(): ?PublicEntityDto
    {
        return $this->publicEntity;
    }

    /**
     * @return static
     */
    public function setPublicEntityId($id): self
    {
        $value = !is_null($id)
            ? new PublicEntityDto($id)
            : null;

        return $this->setPublicEntity($value);
    }

    /**
     * @return mixed | null
     */
    public function getPublicEntityId()
    {
        if ($dto = $this->getPublicEntity()) {
            return $dto->getId();
        }

        return null;
    }

}
