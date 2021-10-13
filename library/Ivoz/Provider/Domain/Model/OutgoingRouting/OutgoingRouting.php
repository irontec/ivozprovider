<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

class OutgoingRouting extends OutgoingRoutingAbstract implements OutgoingRoutingInterface
{
    use OutgoingRoutingTrait;

    /**
     * Available OutgoingRoutings Types
     * @todo restrict values on the setter
     */
    public const TYPE_PATTERN   = 'pattern';
    public const TYPE_GROUP     = 'group';
    public const TYPE_FAX       = 'fax';

    /**
     * Available OugoingRoutings Route Mode
     */
    /** @deprecated */
    public const MODE_STATIC = self::ROUTINGMODE_STATIC;

    /** @deprecated */
    public const MODE_LCR    = self::ROUTINGMODE_LCR;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
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

    protected function setWeight(int $weight): static
    {
        Assertion::between($weight, 1, 20, 'weight provided "%s" is not between "%s" and "%s"');
        return parent::setWeight($weight);
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
            case self::ROUTINGMODE_BLOCK:
                $this->setCarrier(null);
                $this->setStopper(true);
                break;
            default:
                throw new \DomainException('Incorrect Outgoing Routing Mode');
        }

        if (!$this->getForceClid()) {
            $this->setClid(null);
            $this->setClidCountry(null);
        }
    }

    /**
     * @todo awkward return type
     * @return array of \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface or null
     */
    public function getRoutingPatterns()
    {
        switch ($this->getType()) {
            case self::TYPE_GROUP:
                return $this->getRoutingPatternGroup()->getRoutingPatterns();
            case self::TYPE_PATTERN:
                return [ $this->getRoutingPattern() ];
            case self::TYPE_FAX:
                return [ null ];
            default:
                return [ ];
        }
    }

    /**
     * Return CGRates tag for LCR category
     *
     * @return string
     */
    public function getCgrCategory(): string
    {
        return sprintf(
            "or%d",
            $this->getId()
        );
    }

    /**
     * Return CGRates tag for LCR rating plan category
     *
     * @return string
     */
    public function getCgrRpCategory(): string
    {
        return sprintf(
            "lcr_profile%d",
            $this->getId()
        );
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $pattern
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
