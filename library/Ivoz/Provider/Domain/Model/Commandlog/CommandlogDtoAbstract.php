<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CommandlogDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $requestId;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @var array
     */
    private $agent;

    /**
     * @var \DateTime | string
     */
    private $createdOn;

    /**
     * @var integer
     */
    private $microtime;

    /**
     * @var string
     */
    private $id;


    use DtoNormalizer;

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
        return [
            'requestId' => $this->getRequestId(),
            'class' => $this->getClass(),
            'method' => $this->getMethod(),
            'arguments' => $this->getArguments(),
            'agent' => $this->getAgent(),
            'createdOn' => $this->getCreatedOn(),
            'microtime' => $this->getMicrotime(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param string $requestId
     *
     * @return static
     */
    public function setRequestId($requestId = null)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $class
     *
     * @return static
     */
    public function setClass($class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $method
     *
     * @return static
     */
    public function setMethod($method = null)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param array $arguments
     *
     * @return static
     */
    public function setArguments($arguments = null)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $agent
     *
     * @return static
     */
    public function setAgent($agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getAgent()
    {
        return $this->agent;
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
     * @return \DateTime | null
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
     * @return integer | null
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }

    /**
     * @param string $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getId()
    {
        return $this->id;
    }
}
