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
    public static function getPropertyMap(string $context = '', string $role = null)
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param int $setid | null
     *
     * @return static
     */
    public function setSetid(?int $setid = null): self
    {
        $this->setid = $setid;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getSetid(): ?int
    {
        return $this->setid;
    }

    /**
     * @param string $destination | null
     *
     * @return static
     */
    public function setDestination(?string $destination = null): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @param int $flags | null
     *
     * @return static
     */
    public function setFlags(?int $flags = null): self
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFlags(): ?int
    {
        return $this->flags;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param string $attrs | null
     *
     * @return static
     */
    public function setAttrs(?string $attrs = null): self
    {
        $this->attrs = $attrs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAttrs(): ?string
    {
        return $this->attrs;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
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
     * @param ApplicationServerDto | null
     *
     * @return static
     */
    public function setApplicationServer(?ApplicationServerDto $applicationServer = null): self
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * @return ApplicationServerDto | null
     */
    public function getApplicationServer(): ?ApplicationServerDto
    {
        return $this->applicationServer;
    }

    /**
     * @return static
     */
    public function setApplicationServerId($id): self
    {
        $value = !is_null($id)
            ? new ApplicationServerDto($id)
            : null;

        return $this->setApplicationServer($value);
    }

    /**
     * @return mixed | null
     */
    public function getApplicationServerId()
    {
        if ($dto = $this->getApplicationServer()) {
            return $dto->getId();
        }

        return null;
    }

}
