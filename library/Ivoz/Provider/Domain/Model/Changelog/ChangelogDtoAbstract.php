<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Commandlog\CommandlogDto;

/**
* ChangelogDtoAbstract
* @codeCoverageIgnore
*/
abstract class ChangelogDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $entity;

    /**
     * @var string
     */
    private $entityId;

    /**
     * @var array | null
     */
    private $data;

    /**
     * @var \DateTimeInterface
     */
    private $createdOn;

    /**
     * @var int
     */
    private $microtime;

    /**
     * @var string
     */
    private $id;

    /**
     * @var CommandlogDto | null
     */
    private $command;

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
     * @param string $entity | null
     *
     * @return static
     */
    public function setEntity(?string $entity = null): self
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEntity(): ?string
    {
        return $this->entity;
    }

    /**
     * @param string $entityId | null
     *
     * @return static
     */
    public function setEntityId(?string $entityId = null): self
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    /**
     * @param array $data | null
     *
     * @return static
     */
    public function setData(?array $data = null): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param \DateTimeInterface $createdOn | null
     *
     * @return static
     */
    public function setCreatedOn($createdOn = null): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param int $microtime | null
     *
     * @return static
     */
    public function setMicrotime(?int $microtime = null): self
    {
        $this->microtime = $microtime;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMicrotime(): ?int
    {
        return $this->microtime;
    }

    /**
     * @param string $id | null
     *
     * @return static
     */
    public function setId(?string $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param CommandlogDto | null
     *
     * @return static
     */
    public function setCommand(?CommandlogDto $command = null): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return CommandlogDto | null
     */
    public function getCommand(): ?CommandlogDto
    {
        return $this->command;
    }

    /**
     * @return static
     */
    public function setCommandId($id): self
    {
        $value = !is_null($id)
            ? new CommandlogDto($id)
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
