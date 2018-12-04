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
     * @var guid
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
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var integer
     */
    private $microtime;

    /**
     * @var guid
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
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'requestId' => 'requestId',
            'class' => 'class',
            'method' => 'method',
            'arguments' => 'arguments',
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
            'createdOn' => $this->getCreatedOn(),
            'microtime' => $this->getMicrotime(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param guid $requestId
     *
     * @return static
     */
    public function setRequestId($requestId = null)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return guid
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
     * @return string
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
     * @return string
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
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
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
     * @return \DateTime
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
     * @return integer
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }

    /**
     * @param guid $id
     *
     * @return static
     */
    public function setId($id = null)
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
}
