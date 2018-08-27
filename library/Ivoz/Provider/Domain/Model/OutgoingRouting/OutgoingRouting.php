<?php
namespace Ivoz\Provider\Domain\Model\OutgoingRouting;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

/**
 * OutgoingRouting
 */
class OutgoingRouting extends OutgoingRoutingAbstract implements OutgoingRoutingInterface
{
    use OutgoingRoutingTrait;

    /**
     * Available OutgoingRoutings Types
     */
    const TYPE_PATTERN   = 'pattern';
    const TYPE_GROUP     = 'group';
    const TYPE_FAX       = 'fax';

    /**
     * Available OugoingRoutings Route Mode
     */
    const MODE_STATIC = 'static';
    const MODE_LCR    = 'lcr';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        switch ($this->getType()) {
            case self::TYPE_GROUP:
                $this->setRoutingPattern(null);
                break;
            case self::TYPE_PATTERN:
                $this->setRoutingPatternGroup(null);
                break;
            case self::TYPE_FAX:
                $this->setRoutingPattern(null);
                $this->setRoutingPatternGroup(null);
                break;
            default:
                throw new \DomainException('Incorrect Outgoing Routing Type');
        }

        switch ($this->getRoutingMode()) {
            case self::MODE_STATIC:
                $this->replaceRelCarriers(new ArrayCollection());
                break;
            case self::MODE_LCR:
                $this->setCarrier(null);
                break;
            default:
                throw new \DomainException('Incorrect Outgoing Routing Mode');
        }

    }

    /**
     * @return RoutingPatternInterface[]
     */
    public function getRoutingPatterns()
    {
        switch ($this->getType()) {
            case self::TYPE_GROUP:
                return $this->getRoutingPatternGroup()->getRoutingPatterns();
            case self::TYPE_PATTERN:
                return [ $this->getRoutingPattern() ];
            case self::TYPE_FAX:
            default:
                return [ ];
        }
    }

    /**
     * @param RoutingPatternInterface $pattern
     * @return bool
     */
    public function hasRoutingPattern(RoutingPatternInterface $pattern)
    {
        $routingPatterns = $this->getRoutingPatterns();
        foreach ($routingPatterns as $routingPattern) {
            // TODO id checking??
            if ($routingPattern->getId() == $pattern->getId()) {
                return true;
            }
        }

        return false;
    }
}

