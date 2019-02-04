<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;

class HuntGroupCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var HuntGroupInterface
     */
    protected $huntgroup;

    /**
     * HuntGroupAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    ) {
        $this->agi = $agi;
    }

    /**
     * @param HuntGroupInterface|null $huntGroup
     * @return $this
     */
    public function setHuntGroup(HuntGroupInterface $huntGroup = null)
    {
        $this->huntgroup = $huntGroup;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $huntGroup = $this->huntgroup;

        if (is_null($huntGroup)) {
            $this->agi->error("HuntGroup is not properly defined. Check configuration.");
            return;
        }

        // Extract next extension to be called
        $huntGroupEndpoints = explode(';', $this->agi->getVariable("HG_ENDPOINTLIST"));
        $huntGroupTimeouts  = explode(';', $this->agi->getVariable("HG_TIMEOUTLIST"));

        // Next to be called
        $endpointName = array_shift($huntGroupEndpoints);
        $timeout = array_shift($huntGroupTimeouts);

        // Configure Dial options
        $options = "i";

        // Cancelled calls may be marked as 'answered elsewhere'
        if ($huntGroup->getPreventMissedCalls()) {
            $options .= "c";
        }

        // For record asterisk builtin feature code
        if ($huntGroup->getCompany()->getOnDemandRecord() == 2) {
            $options .= "xX";
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);
    }
}
