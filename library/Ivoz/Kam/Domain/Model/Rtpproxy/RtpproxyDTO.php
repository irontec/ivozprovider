<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class RtpproxyDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $setid = '0';

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $flags = '0';

    /**
     * @var integer
     */
    private $weight = '1';

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $mediaRelaySetId;

    /**
     * @var mixed
     */
    private $mediaRelaySet;

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->mediaRelaySet = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\MediaRelaySet\\MediaRelaySet', $this->getMediaRelaySetId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $setid
     *
     * @return RtpproxyDTO
     */
    public function setSetid($setid)
    {
        $this->setid = $setid;

        return $this;
    }

    /**
     * @return string
     */
    public function getSetid()
    {
        return $this->setid;
    }

    /**
     * @param string $url
     *
     * @return RtpproxyDTO
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param integer $flags
     *
     * @return RtpproxyDTO
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param integer $weight
     *
     * @return RtpproxyDTO
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $description
     *
     * @return RtpproxyDTO
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param integer $id
     *
     * @return RtpproxyDTO
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
     * @param integer $mediaRelaySetId
     *
     * @return RtpproxyDTO
     */
    public function setMediaRelaySetId($mediaRelaySetId)
    {
        $this->mediaRelaySetId = $mediaRelaySetId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMediaRelaySetId()
    {
        return $this->mediaRelaySetId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet
     */
    public function getMediaRelaySet()
    {
        return $this->mediaRelaySet;
    }
}


