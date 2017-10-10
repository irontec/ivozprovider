<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * LcrRuleAbstract
 * @codeCoverageIgnore
 */
abstract class LcrRuleAbstract
{
    /**
     * @column lcr_id
     * @var integer
     */
    protected $lcrId = '1';

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @column from_uri
     * @var string
     */
    protected $fromUri;

    /**
     * @column request_uri
     * @var string
     */
    protected $requestUri;

    /**
     * @var integer
     */
    protected $stopper = '0';

    /**
     * @var integer
     */
    protected $enabled = '1';

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    protected $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    protected $outgoingRouting;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $lcrId,
        $stopper,
        $enabled,
        $tag,
        $description
    ) {
        $this->setLcrId($lcrId);
        $this->setStopper($stopper);
        $this->setEnabled($enabled);
        $this->setTag($tag);
        $this->setDescription($description);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return LcrRuleDTO
     */
    public static function createDTO()
    {
        return new LcrRuleDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrRuleDTO
         */
        Assertion::isInstanceOf($dto, LcrRuleDTO::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getStopper(),
            $dto->getEnabled(),
            $dto->getTag(),
            $dto->getDescription());

        return $self
            ->setPrefix($dto->getPrefix())
            ->setFromUri($dto->getFromUri())
            ->setRequestUri($dto->getRequestUri())
            ->setRoutingPattern($dto->getRoutingPattern())
            ->setOutgoingRouting($dto->getOutgoingRouting())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrRuleDTO
         */
        Assertion::isInstanceOf($dto, LcrRuleDTO::class);

        $this
            ->setLcrId($dto->getLcrId())
            ->setPrefix($dto->getPrefix())
            ->setFromUri($dto->getFromUri())
            ->setRequestUri($dto->getRequestUri())
            ->setStopper($dto->getStopper())
            ->setEnabled($dto->getEnabled())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setRoutingPattern($dto->getRoutingPattern())
            ->setOutgoingRouting($dto->getOutgoingRouting());


        return $this;
    }

    /**
     * @return LcrRuleDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setLcrId($this->getLcrId())
            ->setPrefix($this->getPrefix())
            ->setFromUri($this->getFromUri())
            ->setRequestUri($this->getRequestUri())
            ->setStopper($this->getStopper())
            ->setEnabled($this->getEnabled())
            ->setTag($this->getTag())
            ->setDescription($this->getDescription())
            ->setRoutingPatternId($this->getRoutingPattern() ? $this->getRoutingPattern()->getId() : null)
            ->setOutgoingRoutingId($this->getOutgoingRouting() ? $this->getOutgoingRouting()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'lcrId' => self::getLcrId(),
            'prefix' => self::getPrefix(),
            'fromUri' => self::getFromUri(),
            'requestUri' => self::getRequestUri(),
            'stopper' => self::getStopper(),
            'enabled' => self::getEnabled(),
            'tag' => self::getTag(),
            'description' => self::getDescription(),
            'routingPatternId' => self::getRoutingPattern() ? self::getRoutingPattern()->getId() : null,
            'outgoingRoutingId' => self::getOutgoingRouting() ? self::getOutgoingRouting()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set lcrId
     *
     * @param integer $lcrId
     *
     * @return self
     */
    public function setLcrId($lcrId)
    {
        Assertion::notNull($lcrId);
        Assertion::integerish($lcrId);
        Assertion::greaterOrEqualThan($lcrId, 0);

        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * Get lcrId
     *
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix = null)
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 100);
        }

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set fromUri
     *
     * @param string $fromUri
     *
     * @return self
     */
    public function setFromUri($fromUri = null)
    {
        if (!is_null($fromUri)) {
            Assertion::maxLength($fromUri, 255);
        }

        $this->fromUri = $fromUri;

        return $this;
    }

    /**
     * Get fromUri
     *
     * @return string
     */
    public function getFromUri()
    {
        return $this->fromUri;
    }

    /**
     * Set requestUri
     *
     * @param string $requestUri
     *
     * @return self
     */
    public function setRequestUri($requestUri = null)
    {
        if (!is_null($requestUri)) {
            Assertion::maxLength($requestUri, 100);
        }

        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * Get requestUri
     *
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * Set stopper
     *
     * @param integer $stopper
     *
     * @return self
     */
    public function setStopper($stopper)
    {
        Assertion::notNull($stopper);
        Assertion::integerish($stopper);
        Assertion::greaterOrEqualThan($stopper, 0);

        $this->stopper = $stopper;

        return $this;
    }

    /**
     * Get stopper
     *
     * @return integer
     */
    public function getStopper()
    {
        return $this->stopper;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return self
     */
    public function setEnabled($enabled)
    {
        Assertion::notNull($enabled);
        Assertion::integerish($enabled);
        Assertion::greaterOrEqualThan($enabled, 0);

        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag)
    {
        Assertion::notNull($tag);
        Assertion::maxLength($tag, 55);

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        Assertion::notNull($description);
        Assertion::maxLength($description, 500);

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return self
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null)
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }



    // @codeCoverageIgnoreEnd
}

