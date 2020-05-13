<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class AdministratorRelPublicEntityDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var boolean
     */
    private $create = false;

    /**
     * @var boolean
     */
    private $read = true;

    /**
     * @var boolean
     */
    private $update = false;

    /**
     * @var boolean
     */
    private $delete = false;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto | null
     */
    private $administrator;

    /**
     * @var \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto | null
     */
    private $publicEntity;


    use DtoNormalizer;

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
     * @param boolean $create
     *
     * @return static
     */
    public function setCreate($create = null)
    {
        $this->create = $create;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getCreate()
    {
        return $this->create;
    }

    /**
     * @param boolean $read
     *
     * @return static
     */
    public function setRead($read = null)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @param boolean $update
     *
     * @return static
     */
    public function setUpdate($update = null)
    {
        $this->update = $update;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param boolean $delete
     *
     * @return static
     */
    public function setDelete($delete = null)
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $administrator
     *
     * @return static
     */
    public function setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $administrator = null)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto | null
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setAdministratorId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto $publicEntity
     *
     * @return static
     */
    public function setPublicEntity(\Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto $publicEntity = null)
    {
        $this->publicEntity = $publicEntity;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto | null
     */
    public function getPublicEntity()
    {
        return $this->publicEntity;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setPublicEntityId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto($id)
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
