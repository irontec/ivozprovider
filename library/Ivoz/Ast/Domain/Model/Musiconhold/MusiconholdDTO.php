<?php

namespace Ivoz\Ast\Domain\Model\Musiconhold;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class MusiconholdDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var string
     */
    private $application;

    /**
     * @var string
     */
    private $digit;

    /**
     * @var string
     */
    private $sort;

    /**
     * @var string
     */
    private $format;

    /**
     * @var \DateTime
     */
    private $stamp;

    /**
     * @var integer
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'mode' => $this->getMode(),
            'directory' => $this->getDirectory(),
            'application' => $this->getApplication(),
            'digit' => $this->getDigit(),
            'sort' => $this->getSort(),
            'format' => $this->getFormat(),
            'stamp' => $this->getStamp(),
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
     * @param string $name
     *
     * @return MusiconholdDTO
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $mode
     *
     * @return MusiconholdDTO
     */
    public function setMode($mode = null)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $directory
     *
     * @return MusiconholdDTO
     */
    public function setDirectory($directory = null)
    {
        $this->directory = $directory;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $application
     *
     * @return MusiconholdDTO
     */
    public function setApplication($application = null)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * @return string
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param string $digit
     *
     * @return MusiconholdDTO
     */
    public function setDigit($digit = null)
    {
        $this->digit = $digit;

        return $this;
    }

    /**
     * @return string
     */
    public function getDigit()
    {
        return $this->digit;
    }

    /**
     * @param string $sort
     *
     * @return MusiconholdDTO
     */
    public function setSort($sort = null)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param string $format
     *
     * @return MusiconholdDTO
     */
    public function setFormat($format = null)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param \DateTime $stamp
     *
     * @return MusiconholdDTO
     */
    public function setStamp($stamp = null)
    {
        $this->stamp = $stamp;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStamp()
    {
        return $this->stamp;
    }

    /**
     * @param integer $id
     *
     * @return MusiconholdDTO
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


