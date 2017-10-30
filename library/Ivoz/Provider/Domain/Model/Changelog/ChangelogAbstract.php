<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ChangelogAbstract
 * @codeCoverageIgnore
 */
abstract class ChangelogAbstract
{
    /**
     * @var string
     */
    protected $entity;

    /**
     * @var string
     */
    protected $entityId;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface
     */
    protected $command;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($entity, $entityId, $createdOn)
    {
        $this->setEntity($entity);
        $this->setEntityId($entityId);
        $this->setCreatedOn($createdOn);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return ChangelogDTO
     */
    public static function createDTO()
    {
        return new ChangelogDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ChangelogDTO
         */
        Assertion::isInstanceOf($dto, ChangelogDTO::class);

        $self = new static(
            $dto->getEntity(),
            $dto->getEntityId(),
            $dto->getCreatedOn());

        return $self
            ->setData($dto->getData())
            ->setCommand($dto->getCommand())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ChangelogDTO
         */
        Assertion::isInstanceOf($dto, ChangelogDTO::class);

        $this
            ->setEntity($dto->getEntity())
            ->setEntityId($dto->getEntityId())
            ->setData($dto->getData())
            ->setCreatedOn($dto->getCreatedOn())
            ->setCommand($dto->getCommand());


        return $this;
    }

    /**
     * @return ChangelogDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setEntity($this->getEntity())
            ->setEntityId($this->getEntityId())
            ->setData($this->getData())
            ->setCreatedOn($this->getCreatedOn())
            ->setCommandId($this->getCommand() ? $this->getCommand()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'entity' => self::getEntity(),
            'entityId' => self::getEntityId(),
            'data' => self::getData(),
            'createdOn' => self::getCreatedOn(),
            'commandId' => self::getCommand() ? self::getCommand()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return self
     */
    public function setEntity($entity)
    {
        Assertion::notNull($entity);
        Assertion::maxLength($entity, 150);

        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set entityId
     *
     * @param string $entityId
     *
     * @return self
     */
    public function setEntityId($entityId)
    {
        Assertion::notNull($entityId);
        Assertion::maxLength($entityId, 36);

        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set data
     *
     * @param array $data
     *
     * @return self
     */
    public function setData($data = null)
    {
        if (!is_null($data)) {
        }

        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    public function setCreatedOn($createdOn)
    {
        Assertion::notNull($createdOn);
        $createdOn = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set command
     *
     * @param \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command
     *
     * @return self
     */
    public function setCommand(\Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface
     */
    public function getCommand()
    {
        return $this->command;
    }



    // @codeCoverageIgnoreEnd
}

