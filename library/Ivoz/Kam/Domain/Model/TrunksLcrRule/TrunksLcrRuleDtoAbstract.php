<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksLcrRuleDtoAbstract implements DataTransferObjectInterface
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
     * @var string
     */
    private $mtTvalue;

    /**
     * @var integer
     */
    private $stopper = '0';

    /**
     * @var integer
     */
    private $enabled = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto | null
     */
    private $routingPatternGroupsRelPattern;

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
            'mtTvalue' => 'mtTvalue',
            'stopper' => 'stopper',
            'enabled' => 'enabled',
            'id' => 'id',
            'routingPatternId' => 'routingPattern',
            'routingPatternGroupsRelPatternId' => 'routingPatternGroupsRelPattern',
            'outgoingRoutingId' => 'outgoingRouting'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'lcrId' => $this->getLcrId(),
            'prefix' => $this->getPrefix(),
            'fromUri' => $this->getFromUri(),
            'requestUri' => $this->getRequestUri(),
            'mtTvalue' => $this->getMtTvalue(),
            'stopper' => $this->getStopper(),
            'enabled' => $this->getEnabled(),
            'id' => $this->getId(),
            'routingPattern' => $this->getRoutingPattern(),
            'routingPatternGroupsRelPattern' => $this->getRoutingPatternGroupsRelPattern(),
            'outgoingRouting' => $this->getOutgoingRouting()
        ];
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
     * @param string $mtTvalue
     *
     * @return static
     */
    public function setMtTvalue($mtTvalue = null)
    {
        $this->mtTvalue = $mtTvalue;

        return $this;
    }

    /**
     * @return string
     */
    public function getMtTvalue()
    {
        return $this->mtTvalue;
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
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto $routingPatternGroupsRelPattern
     *
     * @return static
     */
    public function setRoutingPatternGroupsRelPattern(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto $routingPatternGroupsRelPattern = null)
    {
        $this->routingPatternGroupsRelPattern = $routingPatternGroupsRelPattern;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto
     */
    public function getRoutingPatternGroupsRelPattern()
    {
        return $this->routingPatternGroupsRelPattern;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRoutingPatternGroupsRelPatternId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto($id)
            : null;

        return $this->setRoutingPatternGroupsRelPattern($value);
    }

    /**
     * @return integer | null
     */
    public function getRoutingPatternGroupsRelPatternId()
    {
        if ($dto = $this->getRoutingPatternGroupsRelPattern()) {
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
