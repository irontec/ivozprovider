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
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var integer
     */
    private $microtime;

    /**
     * @var guid
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
    public static function getPropertyMap(string $context = '')
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
        return [
            'entity' => $this->getEntity(),
            'entityId' => $this->getEntityId(),
            'data' => $this->getData(),
            'createdOn' => $this->getCreatedOn(),
            'microtime' => $this->getMicrotime(),
            'id' => $this->getId(),
            'command' => $this->getCommand()
        ];
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
     * @return string
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
     * @return string
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
     * @return array
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
     * @return \DateTime
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
     * @return integer
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }

    /**
     * @param guid $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return guid
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
     * @return \Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param integer $id | null
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
     * @return integer | null
     */
    public function getCommandId()
    {
        if ($dto = $this->getCommand()) {
            return $dto->getId();
        }

        return null;
    }
}
