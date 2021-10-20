<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* CommandlogDtoAbstract
* @codeCoverageIgnore
*/
abstract class CommandlogDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string|null
     */
    private $method;

    /**
     * @var array|null
     */
    private $arguments;

    /**
     * @var array|null
     */
    private $agent;

    /**
     * @var \DateTimeInterface|string
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
            'requestId' => 'requestId',
            'class' => 'class',
            'method' => 'method',
            'arguments' => 'arguments',
            'agent' => 'agent',
            'createdOn' => 'createdOn',
            'microtime' => 'microtime',
            'id' => 'id'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'requestId' => $this->getRequestId(),
            'class' => $this->getClass(),
            'method' => $this->getMethod(),
            'arguments' => $this->getArguments(),
            'agent' => $this->getAgent(),
            'createdOn' => $this->getCreatedOn(),
            'microtime' => $this->getMicrotime(),
            'id' => $this->getId()
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

    public function setRequestId(?string $requestId): static
    {
        $this->requestId = $requestId;

        return $this;
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    public function setClass(?string $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setMethod(?string $method): static
    {
        $this->method = $method;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setArguments(?array $arguments): static
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    public function setAgent(?array $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function getAgent(): ?array
    {
        return $this->agent;
    }

    public function setCreatedOn(null|\DateTimeInterface|string $createdOn): static
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getCreatedOn(): \DateTimeInterface|string|null
    {
        return $this->createdOn;
    }

    public function setMicrotime(?int $microtime): static
    {
        $this->microtime = $microtime;

        return $this;
    }

    public function getMicrotime(): ?int
    {
        return $this->microtime;
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
}
