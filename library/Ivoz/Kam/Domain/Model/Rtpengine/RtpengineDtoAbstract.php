<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RtpengineDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $setid = 0;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $weight = 1;

    /**
     * @var boolean
     */
    private $disabled = '0';

    /**
     * @var \DateTime
     */
    private $stamp = '2000-01-01 00:00:00';

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
            'weight' => 'weight',
            'disabled' => 'disabled',
            'stamp' => 'stamp',
            'description' => 'description',
            'id' => 'id',
            'mediaRelaySetId' => 'mediaRelaySet'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'setid' => $this->getSetid(),
            'url' => $this->getUrl(),
            'weight' => $this->getWeight(),
            'disabled' => $this->getDisabled(),
            'stamp' => $this->getStamp(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'mediaRelaySet' => $this->getMediaRelaySet()
        ];
    }

    /**
     * @param integer $setid
     *
     * @return static
     */
    public function setSetid($setid = null)
    {
        $this->setid = $setid;

        return $this;
    }

    /**
     * @return integer
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
     * @param boolean $disabled
     *
     * @return static
     */
    public function setDisabled($disabled = null)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param \DateTime $stamp
     *
     * @return static
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
