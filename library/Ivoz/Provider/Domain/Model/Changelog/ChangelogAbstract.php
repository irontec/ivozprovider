<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @var array | null
     */
    protected $data;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var integer
     */
    protected $microtime;

    /**
     * @var \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface
     */
    protected $command;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $entity,
        $entityId,
        $createdOn,
        $microtime
    ) {
        $this->setEntity($entity);
        $this->setEntityId($entityId);
        $this->setCreatedOn($createdOn);
        $this->setMicrotime($microtime);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Changelog",
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
     * @return ChangelogDto
     */
    public static function createDto($id = null)
    {
        return new ChangelogDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return ChangelogDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ChangelogInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ChangelogDto
         */
        Assertion::isInstanceOf($dto, ChangelogDto::class);

        $self = new static(
            $dto->getEntity(),
            $dto->getEntityId(),
            $dto->getCreatedOn(),
            $dto->getMicrotime()
        );

        $self
            ->setData($dto->getData())
            ->setCommand($fkTransformer->transform($dto->getCommand()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ChangelogDto
         */
        Assertion::isInstanceOf($dto, ChangelogDto::class);

        $this
            ->setEntity($dto->getEntity())
            ->setEntityId($dto->getEntityId())
            ->setData($dto->getData())
            ->setCreatedOn($dto->getCreatedOn())
            ->setMicrotime($dto->getMicrotime())
            ->setCommand($fkTransformer->transform($dto->getCommand()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ChangelogDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setEntity(self::getEntity())
            ->setEntityId(self::getEntityId())
            ->setData(self::getData())
            ->setCreatedOn(self::getCreatedOn())
            ->setMicrotime(self::getMicrotime())
            ->setCommand(\Ivoz\Provider\Domain\Model\Commandlog\Commandlog::entityToDto(self::getCommand(), $depth));
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
            'microtime' => self::getMicrotime(),
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
    protected function setEntity($entity)
    {
        Assertion::notNull($entity, 'entity value "%s" is null, but non null value was expected.');
        Assertion::maxLength($entity, 150, 'entity value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setEntityId($entityId)
    {
        Assertion::notNull($entityId, 'entityId value "%s" is null, but non null value was expected.');
        Assertion::maxLength($entityId, 36, 'entityId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setData($data = null)
    {
        if (!is_null($data)) {
        }

        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array | null
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
    protected function setCreatedOn($createdOn)
    {
        Assertion::notNull($createdOn, 'createdOn value "%s" is null, but non null value was expected.');
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
        return clone $this->createdOn;
    }

    /**
     * Set microtime
     *
     * @param integer $microtime
     *
     * @return self
     */
    protected function setMicrotime($microtime)
    {
        Assertion::notNull($microtime, 'microtime value "%s" is null, but non null value was expected.');
        Assertion::integerish($microtime, 'microtime value "%s" is not an integer or a number castable to integer.');

        $this->microtime = (int) $microtime;

        return $this;
    }

    /**
     * Get microtime
     *
     * @return integer
     */
    public function getMicrotime()
    {
        return $this->microtime;
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
