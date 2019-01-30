<?php

namespace Agi\Agents;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

class DdiAgent implements AgentInterface
{
    use AgentTrait;

    /** @var Wrapper */
    private $agi;

    /** @var DdiInterface */
    private $ddi;

    /**
     * DdiAgent constructor.
     *
     * @param Wrapper $agi
     * @param DdiInterface $ddi
     */
    public function __construct(
        Wrapper $agi,
        DdiInterface $ddi
    ) {
        $this->agi = $agi;
        $this->ddi = $ddi;
    }

    public function getType()
    {
        return "Ddi";
    }

    public function getId()
    {
        return $this->ddi->getId();
    }

    public function getCompany()
    {
        return $this->ddi->getCompany();
    }

    public function getLanguageCode()
    {
        return $this->ddi->getLanguageCode();
    }

    public function getOutgoingDdi($destination)
    {
        // Default DDI is ourselves
        $ddi = $this->ddi;

        // If user has OutgoingDDI rules, check if we have to override current DDI
        $outgoingDDIRule = $this->getCompany()->getOutgoingDDIRule();
        if ($outgoingDDIRule) {
            $this->agi->verbose("Checking %s for destination %s", $outgoingDDIRule, $destination);
            // Check if outgoing DDI rule matches for given destination
            $ddiRule = $outgoingDDIRule->getOutgoingDDI($ddi, $destination);
            if ($ddiRule) {
                $this->agi->notice("Rule %s enforces DDI update to %s", $outgoingDDIRule, $ddiRule);
                $ddi = $ddiRule;
            }
        }

        return $ddi;
    }

    /**
     * @param string $destination
     * @return boolean
     */
    public function isAllowedToCall($destination)
    {
        return true;
    }
}
