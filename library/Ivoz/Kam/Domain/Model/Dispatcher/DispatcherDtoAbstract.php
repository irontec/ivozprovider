<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto;

/**
* DispatcherDtoAbstract
* @codeCoverageIgnore
*/
abstract class DispatcherDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $setid = 0;

    /**
     * @var string
     */
    private $destination = '';

    /**
     * @var int
     */
    private $flags = 0;

    /**
     * @var int
     */
    private $priority = 0;

    /**
     * @var string
     */
    private $attrs = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var ApplicationServerDto | null
     */
    private $applicationServer;

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
            'setid' => 'setid',
            'destination' => 'destination',
            'flags' => 'flags',
            'priority' => 'priority',
            'attrs' => 'attrs',
            'description' => 'description',
            'id' => 'id',
            'applicationServerId' => 'applicationServer'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'setid' => $this->getSetid(),
            'destination' => $this->getDestination(),
            'flags' => $this->getFlags(),
            'priority' => $this->getPriority(),
            'attrs' => $this->getAttrs(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'applicationServer' => $this->getApplicationServer()
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

    public function setSetid(int $setid): static
    {
        $this->setid = $setid;

        return $this;
    }

    public function getSetid(): ?int
    {
        return $this->setid;
    }

    public function setDestination(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): ?int
    {
        return $this->flags;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setAttrs(string $attrs): static
    {
        $this->attrs = $attrs;

        return $this;
    }

    public function getAttrs(): ?string
    {
        return $this->attrs;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setApplicationServer(?ApplicationServerDto $applicationServer): static
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    public function getApplicationServer(): ?ApplicationServerDto
    {
        return $this->applicationServer;
    }

    public function setApplicationServerId($id): static
    {
        $value = !is_null($id)
            ? new ApplicationServerDto($id)
            : null;

        return $this->setApplicationServer($value);
    }

    public function getApplicationServerId()
    {
        if ($dto = $this->getApplicationServer()) {
            return $dto->getId();
        }

        return null;
    }
}
