<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpDestinationDtoAbstract implements DataTransferObjectInterface
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
     * @var \DateTime | string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Destination\DestinationDto | null
     */
    private $destination;


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
            'tpid' => 'tpid',
            'tag' => 'tag',
            'prefix' => 'prefix',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'destinationId' => 'destination'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'prefix' => $this->getPrefix(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'destination' => $this->getDestination()
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
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $tag
     *
     * @return static
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationDto $destination
     *
     * @return static
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationDto $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationDto | null
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setDestinationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Destination\DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    /**
     * @return mixed | null
     */
    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }
}
