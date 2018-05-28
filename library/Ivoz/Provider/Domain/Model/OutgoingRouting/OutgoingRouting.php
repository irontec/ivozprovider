<?php
namespace Ivoz\Provider\Domain\Model\OutgoingRouting;
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
    const PATTERN   = 'pattern';
    const GROUP     = 'group';
    const FAX       = 'fax';

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
            case 'group':
                $this->setRoutingPattern(null);
                break;
            case 'pattern':
                $this->setRoutingPatternGroup(null);
                break;
            case 'fax':
                $this->setRoutingPattern(null);
                $this->setRoutingPatternGroup(null);
                break;
            default:
                throw new \DomainException('Incorrect Outgoing Routing Type');
        }
    }

    /**
     * @return array|RoutingPatternInterface[]
     */
    public function getRoutingPatterns()
    {
        switch ($this->getType()) {
            case OutgoingRouting::GROUP:
                return $this->getRoutingPatternGroup()->getRoutingPatterns();
            case OutgoingRouting::PATTERN:
                return [ $this->getRoutingPattern() ];
            case OutgoingRouting::FAX:
            default:
                return [ ];
        }
    }

    /**
     * @param RoutingPatternInterface $pattern
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

