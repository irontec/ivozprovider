<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ChangelogDTO implements DataTransferObjectInterface
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
     * @var guid
     */
    private $id;

    /**
     * @var mixed
     */
    private $commandId;

    /**
     * @var mixed
     */
    private $command;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'entity' => $this->getEntity(),
            'entityId' => $this->getEntityId(),
            'data' => $this->getData(),
            'createdOn' => $this->getCreatedOn(),
            'id' => $this->getId(),
            'commandId' => $this->getCommandId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->command = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Commandlog\\Commandlog', $this->getCommandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $entity
     *
     * @return ChangelogDTO
     */
    public function setEntity($entity)
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
     * @return ChangelogDTO
     */
    public function setEntityId($entityId)
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
     * @return ChangelogDTO
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
     * @return ChangelogDTO
     */
    public function setCreatedOn($createdOn)
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
     * @param guid $id
     *
     * @return ChangelogDTO
     */
    public function setId($id)
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
     * @param integer $commandId
     *
     * @return ChangelogDTO
     */
    public function setCommandId($commandId)
    {
        $this->commandId = $commandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCommandId()
    {
        return $this->commandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Commandlog\Commandlog
     */
    public function getCommand()
    {
        return $this->command;
    }
}


