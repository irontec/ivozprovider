<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Changelog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface;
use Ivoz\Provider\Domain\Model\Commandlog\Commandlog;

/**
* ChangelogAbstract
* @codeCoverageIgnore
*/
abstract class ChangelogAbstract
{
    use ChangelogTrait;

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
    protected $data = [];

    /**
     * @var \DateTimeInterface
     */
    protected $createdOn;

    /**
     * @var int
     */
    protected $microtime;

    /**
     * @var CommandlogInterface
     */
    protected $command;

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
     * @param ChangelogInterface|null $entity
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

        /** @var ChangelogDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ChangelogDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ChangelogDto::class);

        $self = new static(
            $dto->getEntity(),
            $dto->getEntityId(),
            $dto->getCreatedOn(),
            $dto->getMicrotime()
        );

        $self
            ->setData($dto->getData())
            ->setCommand($fkTransformer->transform($dto->getCommand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ChangelogDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ChangelogDto::class);

        $this
            ->setEntity($dto->getEntity())
            ->setEntityId($dto->getEntityId())
            ->setData($dto->getData())
            ->setCreatedOn($dto->getCreatedOn())
            ->setMicrotime($dto->getMicrotime())
            ->setCommand($fkTransformer->transform($dto->getCommand()));

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
            ->setCommand(Commandlog::entityToDto(self::getCommand(), $depth));
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
            'commandId' => self::getCommand()->getId()
        ];
    }

    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return static
     */
    protected function setEntity(string $entity): ChangelogInterface
    {
        Assertion::maxLength($entity, 150, 'entity value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * Set entityId
     *
     * @param string $entityId
     *
     * @return static
     */
    protected function setEntityId(string $entityId): ChangelogInterface
    {
        Assertion::maxLength($entityId, 36, 'entityId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return string
     */
    public function getEntityId(): string
    {
        return $this->entityId;
    }

    /**
     * Set data
     *
     * @param array $data | null
     *
     * @return static
     */
    protected function setData(?array $data = null): ChangelogInterface
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array | null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * Set createdOn
     *
     * @param \DateTimeInterface $createdOn
     *
     * @return static
     */
    protected function setCreatedOn($createdOn): ChangelogInterface
    {

        $createdOn = DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        if ($this->createdOn == $createdOn) {
            return $this;
        }

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTimeInterface
     */
    public function getCreatedOn(): \DateTimeInterface
    {
        return clone $this->createdOn;
    }

    /**
     * Set microtime
     *
     * @param int $microtime
     *
     * @return static
     */
    protected function setMicrotime(int $microtime): ChangelogInterface
    {
        $this->microtime = $microtime;

        return $this;
    }

    /**
     * Get microtime
     *
     * @return int
     */
    public function getMicrotime(): int
    {
        return $this->microtime;
    }

    /**
     * Set command
     *
     * @param CommandlogInterface
     *
     * @return static
     */
    protected function setCommand(CommandlogInterface $command): ChangelogInterface
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return CommandlogInterface
     */
    public function getCommand(): CommandlogInterface
    {
        return $this->command;
    }

}
