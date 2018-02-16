<?php
namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

/**
 * OutgoingRouting
 */
class OutgoingRouting extends OutgoingRoutingAbstract implements OutgoingRoutingInterface
{
    use OutgoingRoutingTrait;

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
}

