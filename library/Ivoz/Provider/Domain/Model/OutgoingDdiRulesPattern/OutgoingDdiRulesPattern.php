<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

/**
 * OutgoingDdiRulesPattern
 */
class OutgoingDdiRulesPattern extends OutgoingDdiRulesPatternAbstract implements OutgoingDdiRulesPatternInterface
{
    use OutgoingDdiRulesPatternTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return forced Ddi for this rule pattern
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getForcedDdi()
    {
        $ddi = parent::getForcedDdi();
        if ($ddi) {
            return $ddi;
        }

        return $this
            ->getOutgoingDdiRule()
            ->getCompany()
            ->getOutgoingDdi();
    }
}

