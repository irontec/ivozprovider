<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ChangelogDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $entity;

    /**
     * @var string
     */
    private $entityId;

    /**
     * @var array
     */
    private $data;

    /**
     * @var \DateTime | string
     */
    private $createdOn;

    /**
     * @var integer
     */
    private $microtime;

    /**
     * @var string
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto | null
     */
    private $command;


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
            'entity' => 'entity',
            'entityId' => 'entityId',
            'data' => 'data',
            'createdOn' => 'createdOn',
            'microtime' => 'microtime',
            'id' => 'id',
            'commandId' => 'command'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'entity' => $this->getEntity(),
            'entityId' => $this->getEntityId(),
            'data' => $this->getData(),
            'createdOn' => $this->getCreatedOn(),
            'microtime' => $this->getMicrotime(),
            'id' => $this->getId(),
            'command' => $this->getCommand()
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
     * @param string $entity
     *
     * @return static
     */
    public function setEntity($entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param string $entityId
     *
     * @return static
     */
    public function setEntityId($entityId = null)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param array $data
     *
     * @return static
     */
    public function setData($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \DateTime $createdOn
     *
     * @return static
     */
    public function setCreatedOn($createdOn = null)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param integer $microtime
     *
     * @return static
     */
    public function setMicrotime($microtime = null)
    {
        $this->microtime = $microtime;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }

    /**
     * @param string $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto $command
     *
     * @return static
     */
    public function setCommand(\Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto $command = null)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto | null
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCommandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto($id)
            : null;

        return $this->setCommand($value);
    }

    /**
     * @return mixed | null
     */
    public function getCommandId()
    {
        if ($dto = $this->getCommand()) {
            return $dto->getId();
        }

        return null;
    }
}
