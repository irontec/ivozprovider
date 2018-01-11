<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class LcrRuleDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $lcrId = '1';

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $fromUri;

    /**
     * @var string
     */
    private $requestUri;

    /**
     * @var integer
     */
    private $stopper = '0';

    /**
     * @var integer
     */
    private $enabled = '1';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto | null
     */
    private $outgoingRouting;


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
            'lcrId' => 'lcrId',
            'prefix' => 'prefix',
            'fromUri' => 'fromUri',
            'requestUri' => 'requestUri',
            'stopper' => 'stopper',
            'enabled' => 'enabled',
            'tag' => 'tag',
            'description' => 'description',
            'id' => 'id',
            'routingPattern' => 'routingPattern',
            'outgoingRouting' => 'outgoingRouting'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'lcrId' => $this->getLcrId(),
            'prefix' => $this->getPrefix(),
            'fromUri' => $this->getFromUri(),
            'requestUri' => $this->getRequestUri(),
            'stopper' => $this->getStopper(),
            'enabled' => $this->getEnabled(),
            'tag' => $this->getTag(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'routingPattern' => $this->getRoutingPattern(),
            'outgoingRouting' => $this->getOutgoingRouting()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->routingPattern = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RoutingPattern\\RoutingPattern', $this->getRoutingPatternId());
        $this->outgoingRouting = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\OutgoingRouting\\OutgoingRouting', $this->getOutgoingRoutingId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $lcrId
     *
     * @return static
     */
    public function setLcrId($lcrId = null)
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
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
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $fromUri
     *
     * @return static
     */
    public function setFromUri($fromUri = null)
    {
        $this->fromUri = $fromUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromUri()
    {
        return $this->fromUri;
    }

    /**
     * @param string $requestUri
     *
     * @return static
     */
    public function setRequestUri($requestUri = null)
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param integer $stopper
     *
     * @return static
     */
    public function setStopper($stopper = null)
    {
        $this->stopper = $stopper;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStopper()
    {
        return $this->stopper;
    }

    /**
     * @param integer $enabled
     *
     * @return static
     */
    public function setEnabled($enabled = null)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
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
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
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
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto $routingPattern
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setRoutingPatternId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto($id)
                : null;

            return $this->setRoutingPattern($value);
        }

        /**
         * @return integer | null
         */
        public function getRoutingPatternId()
        {
            if ($dto = $this->getRoutingPattern()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto $outgoingRouting
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto $outgoingRouting = null)
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setOutgoingRoutingId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto($id)
                : null;

            return $this->setOutgoingRouting($value);
        }

        /**
         * @return integer | null
         */
        public function getOutgoingRoutingId()
        {
            if ($dto = $this->getOutgoingRouting()) {
                return $dto->getId();
            }

            return null;
        }
}


