<?php

namespace Ivoz\Provider\Domain\Model\XMLRPCLog;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class XMLRPCLogDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $proxy;

    /**
     * @var string
     */
    private $module;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $mapperName;

    /**
     * @var \DateTime
     */
    private $startDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $execDate;

    /**
     * @var \DateTime
     */
    private $finishDate;

    /**
     * @var integer
     */
    private $id;

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
     * @param string $proxy
     *
     * @return XMLRPCLogDTO
     */
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * @param string $module
     *
     * @return XMLRPCLogDTO
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param string $method
     *
     * @return XMLRPCLogDTO
     */
    public function setMethod($method)
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
     * @param string $mapperName
     *
     * @return XMLRPCLogDTO
     */
    public function setMapperName($mapperName)
    {
        $this->mapperName = $mapperName;

        return $this;
    }

    /**
     * @return string
     */
    public function getMapperName()
    {
        return $this->mapperName;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return XMLRPCLogDTO
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $execDate
     *
     * @return XMLRPCLogDTO
     */
    public function setExecDate($execDate = null)
    {
        $this->execDate = $execDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExecDate()
    {
        return $this->execDate;
    }

    /**
     * @param \DateTime $finishDate
     *
     * @return XMLRPCLogDTO
     */
    public function setFinishDate($finishDate = null)
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param integer $id
     *
     * @return XMLRPCLogDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}


