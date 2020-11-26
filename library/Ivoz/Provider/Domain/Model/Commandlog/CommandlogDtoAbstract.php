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
     * @var string | null
     */
    private $method;

    /**
     * @var array | null
     */
    private $arguments;

    /**
     * @var array | null
     */
    private $agent;

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

    /**
     * @param string $requestId | null
     *
     * @return static
     */
    public function setRequestId(?string $requestId = null): self
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * @param string $class | null
     *
     * @return static
     */
    public function setClass(?string $class = null): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param string $method | null
     *
     * @return static
     */
    public function setMethod(?string $method = null): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param array $arguments | null
     *
     * @return static
     */
    public function setArguments(?array $arguments = null): self
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    /**
     * @param array $agent | null
     *
     * @return static
     */
    public function setAgent(?array $agent = null): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getAgent(): ?array
    {
        return $this->agent;
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

}
