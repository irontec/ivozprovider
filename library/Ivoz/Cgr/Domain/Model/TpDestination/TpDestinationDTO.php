<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpDestinationDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $destinationId;

    /**
     * @var mixed
     */
    private $destination;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'prefix' => $this->getPrefix(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'destinationId' => $this->getDestinationId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->destination = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\Destination\\Destination', $this->getDestinationId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return TpDestinationDTO
     */
    public function setTpid($tpid)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $tag
     *
     * @return TpDestinationDTO
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $prefix
     *
     * @return TpDestinationDTO
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return TpDestinationDTO
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     *
     * @return TpDestinationDTO
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

    /**
     * @param integer $destinationId
     *
     * @return TpDestinationDTO
     */
    public function setDestinationId($destinationId)
    {
        $this->destinationId = $destinationId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDestinationId()
    {
        return $this->destinationId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\Destination\Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }
}


