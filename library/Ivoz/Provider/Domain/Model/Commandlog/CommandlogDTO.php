<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class CommandlogDTO implements DataTransferObjectInterface
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
     * @var guid
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'requestId' => $this->getRequestId(),
            'class' => $this->getClass(),
            'method' => $this->getMethod(),
            'arguments' => $this->getArguments(),
            'createdOn' => $this->getCreatedOn(),
            'id' => $this->getId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param guid $requestId
     *
     * @return CommandlogDTO
     */
    public function setRequestId($requestId)
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
     * @return CommandlogDTO
     */
    public function setClass($class)
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
     * @return CommandlogDTO
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
     * @return CommandlogDTO
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
     * @return CommandlogDTO
     */
    public function setCreatedOn($createdOn)
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
     * @param guid $id
     *
     * @return CommandlogDTO
     */
    public function setId($id)
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


