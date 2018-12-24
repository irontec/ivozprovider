<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksLcrRuleAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksLcrRuleAbstract
{
    /**
     * column: lcr_id
     * @var integer
     */
    protected $lcrId = '1';

    /**
     * @var string | null
     */
    protected $prefix;

    /**
     * column: from_uri
     * @var string | null
     */
    protected $fromUri;

    /**
     * column: request_uri
     * @var string | null
     */
    protected $requestUri;

    /**
     * column: mt_tvalue
     * @var string | null
     */
    protected $mtTvalue;

    /**
     * @var integer
     */
    protected $stopper = '0';

    /**
     * @var integer
     */
    protected $enabled = '1';

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    protected $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface
     */
    protected $routingPatternGroupsRelPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    protected $outgoingRouting;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($lcrId, $stopper, $enabled)
    {
        $this->setLcrId($lcrId);
        $this->setStopper($stopper);
        $this->setEnabled($enabled);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TrunksLcrRule",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return TrunksLcrRuleDto
     */
    public static function createDto($id = null)
    {
        return new TrunksLcrRuleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrunksLcrRuleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksLcrRuleInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksLcrRuleDto
         */
        Assertion::isInstanceOf($dto, TrunksLcrRuleDto::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getStopper(),
            $dto->getEnabled()
        );

        $self
            ->setPrefix($dto->getPrefix())
            ->setFromUri($dto->getFromUri())
            ->setRequestUri($dto->getRequestUri())
            ->setMtTvalue($dto->getMtTvalue())
            ->setRoutingPattern($dto->getRoutingPattern())
            ->setRoutingPatternGroupsRelPattern($dto->getRoutingPatternGroupsRelPattern())
            ->setOutgoingRouting($dto->getOutgoingRouting())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksLcrRuleDto
         */
        Assertion::isInstanceOf($dto, TrunksLcrRuleDto::class);

        $this
            ->setLcrId($dto->getLcrId())
            ->setPrefix($dto->getPrefix())
            ->setFromUri($dto->getFromUri())
            ->setRequestUri($dto->getRequestUri())
            ->setMtTvalue($dto->getMtTvalue())
            ->setStopper($dto->getStopper())
            ->setEnabled($dto->getEnabled())
            ->setRoutingPattern($dto->getRoutingPattern())
            ->setRoutingPatternGroupsRelPattern($dto->getRoutingPatternGroupsRelPattern())
            ->setOutgoingRouting($dto->getOutgoingRouting());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrunksLcrRuleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setLcrId(self::getLcrId())
            ->setPrefix(self::getPrefix())
            ->setFromUri(self::getFromUri())
            ->setRequestUri(self::getRequestUri())
            ->setMtTvalue(self::getMtTvalue())
            ->setStopper(self::getStopper())
            ->setEnabled(self::getEnabled())
            ->setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern::entityToDto(self::getRoutingPattern(), $depth))
            ->setRoutingPatternGroupsRelPattern(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern::entityToDto(self::getRoutingPatternGroupsRelPattern(), $depth))
            ->setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'lcr_id' => self::getLcrId(),
            'prefix' => self::getPrefix(),
            'from_uri' => self::getFromUri(),
            'request_uri' => self::getRequestUri(),
            'mt_tvalue' => self::getMtTvalue(),
            'stopper' => self::getStopper(),
            'enabled' => self::getEnabled(),
            'routingPatternId' => self::getRoutingPattern() ? self::getRoutingPattern()->getId() : null,
            'routingPatternGroupsRelPatternId' => self::getRoutingPatternGroupsRelPattern() ? self::getRoutingPatternGroupsRelPattern()->getId() : null,
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
    protected function setLcrId($lcrId)
    {
        Assertion::notNull($lcrId, 'lcrId value "%s" is null, but non null value was expected.');
        Assertion::integerish($lcrId, 'lcrId value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($lcrId, 0, 'lcrId provided "%s" is not greater or equal than "%s".');

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
    protected function setPrefix($prefix = null)
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 100, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string | null
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
    protected function setFromUri($fromUri = null)
    {
        if (!is_null($fromUri)) {
            Assertion::maxLength($fromUri, 255, 'fromUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromUri = $fromUri;

        return $this;
    }

    /**
     * Get fromUri
     *
     * @return string | null
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
    protected function setRequestUri($requestUri = null)
    {
        if (!is_null($requestUri)) {
            Assertion::maxLength($requestUri, 100, 'requestUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * Get requestUri
     *
     * @return string | null
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * Set mtTvalue
     *
     * @param string $mtTvalue
     *
     * @return self
     */
    protected function setMtTvalue($mtTvalue = null)
    {
        if (!is_null($mtTvalue)) {
            Assertion::maxLength($mtTvalue, 128, 'mtTvalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mtTvalue = $mtTvalue;

        return $this;
    }

    /**
     * Get mtTvalue
     *
     * @return string | null
     */
    public function getMtTvalue()
    {
        return $this->mtTvalue;
    }

    /**
     * Set stopper
     *
     * @param integer $stopper
     *
     * @return self
     */
    protected function setStopper($stopper)
    {
        Assertion::notNull($stopper, 'stopper value "%s" is null, but non null value was expected.');
        Assertion::integerish($stopper, 'stopper value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($stopper, 0, 'stopper provided "%s" is not greater or equal than "%s".');

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
    protected function setEnabled($enabled)
    {
        Assertion::notNull($enabled, 'enabled value "%s" is null, but non null value was expected.');
        Assertion::integerish($enabled, 'enabled value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($enabled, 0, 'enabled provided "%s" is not greater or equal than "%s".');

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
     * Set routingPatternGroupsRelPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $routingPatternGroupsRelPattern
     *
     * @return self
     */
    public function setRoutingPatternGroupsRelPattern(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $routingPatternGroupsRelPattern = null)
    {
        $this->routingPatternGroupsRelPattern = $routingPatternGroupsRelPattern;

        return $this;
    }

    /**
     * Get routingPatternGroupsRelPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface | null
     */
    public function getRoutingPatternGroupsRelPattern()
    {
        return $this->routingPatternGroupsRelPattern;
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
