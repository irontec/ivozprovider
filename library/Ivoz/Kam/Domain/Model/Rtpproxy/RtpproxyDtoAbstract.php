<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RtpproxyDtoAbstract implements DataTransferObjectInterface
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
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto | null
     */
    private $mediaRelaySet;


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
            'setid' => 'setid',
            'url' => 'url',
            'flags' => 'flags',
            'weight' => 'weight',
            'description' => 'description',
            'id' => 'id',
            'mediaRelaySet' => 'mediaRelaySet'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'setid' => $this->getSetid(),
            'url' => $this->getUrl(),
            'flags' => $this->getFlags(),
            'weight' => $this->getWeight(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'mediaRelaySet' => $this->getMediaRelaySet()
        ];
    }

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
     * @return static
     */
    public function setSetid($setid = null)
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
     * @return static
     */
    public function setUrl($url = null)
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
     * @return static
     */
    public function setFlags($flags = null)
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
     * @return static
     */
    public function setWeight($weight = null)
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
     * @return static
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
     * @return static
     */
    public function setId($id = null)
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
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto $mediaRelaySet
     *
     * @return static
     */
    public function setMediaRelaySet(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto $mediaRelaySet = null)
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto
     */
    public function getMediaRelaySet()
    {
        return $this->mediaRelaySet;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setMediaRelaySetId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto($id)
                : null;

            return $this->setMediaRelaySet($value);
        }

        /**
         * @return integer | null
         */
        public function getMediaRelaySetId()
        {
            if ($dto = $this->getMediaRelaySet()) {
                return $dto->getId();
            }

            return null;
        }
}


