<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;

class HuntGroupStatusAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var HuntGroupInterface|null
     */
    protected $huntgroup;

    /**
     * HuntGroupAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
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

        // User answered the call. Job's done.
        $dialStatus = $this->agi->getVariable("DIALSTATUS");
        if ($dialStatus == "ANSWER") {
            return;
        }

        // Check pending calls
        $huntGroupEndpoints = explode(';', $this->agi->getVariable("HG_ENDPOINTLIST"));
        $huntGroupTimeouts   = explode(';', $this->agi->getVariable("HG_TIMEOUTLIST"));

        // Get last called extension
        $endpointName = array_shift($huntGroupEndpoints);
        $timeout = array_shift($huntGroupTimeouts);

        // Round Robin strategy infinite loop
        if ($huntGroup->getStrategy() == HuntGroupInterface::STRATEGY_ROUNDROBIN) {
            // Push again the called user to the end of the list
            if ($dialStatus == "NOANSWER") {
                // Push again the interface to the back of the list
                array_push($huntGroupEndpoints, $endpointName);
                array_push($huntGroupTimeouts, $timeout);
            }
        }

        // No more users to be called
        if (empty($huntGroupEndpoints)) {
            $this->agi->verbose("Processing Hungroup %s no answer handler.", $huntGroup);

            // Play NoAnswer Locution
            $this->agi->playbackLocution($huntGroup->getNoAnswerLocution());

            // Route to destination
            $this->routerAction
                ->setRouteType($huntGroup->getNoAnswerTargetType())
                ->setRouteExtension($huntGroup->getNoAnswerExtension())
                ->setRouteVoicemail($huntGroup->getNoAnswerVoicemail())
                ->setRouteExternal($huntGroup->getNoAnswerNumberValueE164())
                ->route();

            return;
        }

        // Update pending extensions
        $this->agi->setVariable("HG_ENDPOINTLIST", join(';', $huntGroupEndpoints));
        $this->agi->setVariable("HG_TIMEOUTLIST", join(';', $huntGroupTimeouts));

        // Call next!
        $this->agi->redirect('call-huntgroup');
    }
}
