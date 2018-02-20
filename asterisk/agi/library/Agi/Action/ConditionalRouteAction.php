<?php

namespace Agi\Action;

class ConditionalRouteAction extends RouterAction
{
    protected $conditionalRoute;

    public function setConditionalRoute($conditionalRoute)
    {
        $this->conditionalRoute = $conditionalRoute;
        return $this;
    }

    public function process()
    {
        // Check route is defined
        $route = $this->conditionalRoute;
        if (empty($route)) {
            $this->agi->error("Conditional Route is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing conditional route \e[0;37m%s [conditionalRoute%d]\e[0;93m",
                        $route->getName(), $route->getId());

        // Set Default Route options
        $locution               = $route->getLocution();
        $this->_routeType       = $route->getRouteType();
        $this->_routeUser       = $route->getUser();
        $this->_routeIVRCommon  = $route->getIVRCommon();
        $this->_routeIVRCustom  = $route->getIVRCustom();
        $this->_routeHuntGroup  = $route->getHuntGroup();
        $this->_routeVoiceMail  = $route->getVoiceMailUser();
        $this->_routeExternal   = $route->getNumberValue();
        $this->_routeFriend     = $route->getFriendValue();
        $this->_routeQueue      = $route->getQueue();
        $this->_routeConference = $route->getConferenceRoom();
        $this->_routeExtension  = $route->getExtension();

        // Check route conditions
        $conditions = $route->getConditionalRoutesConditions(null, 'priority ASC');
        foreach ($conditions as $condition) {

            // Check origin matches route condition
            if (!$condition->matchesOrigin($this->agi->getOrigCallerIdNum())) {
                continue;
            }

            // Check schedule matches route condition
            if (!$condition->matchesSchedule()) {
                continue;
            }

            // Check current day matches route condition
            if (!$condition->matchesCalendar()) {
                continue;
            }

            // Check any of the locks is open
            if (!$condition->matchesRouteLock()) {
                continue;
            }

            // Condition matches, change default route
            $this->agi->verbose("Conditional route priority %d matches all conditions.",
                $condition->getPriority());

            // All condition matches, route using its configuration
            $locution               = $condition->getLocution();
            $this->_routeType       = $condition->getRouteType();
            $this->_routeUser       = $condition->getUser();
            $this->_routeIVRCommon  = $condition->getIVRCommon();
            $this->_routeIVRCustom  = $condition->getIVRCustom();
            $this->_routeHuntGroup  = $condition->getHuntGroup();
            $this->_routeVoiceMail  = $condition->getVoiceMailUser();
            $this->_routeExternal   = $condition->getNumberValue();
            $this->_routeFriend     = $condition->getFriendValue();
            $this->_routeQueue      = $condition->getQueue();
            $this->_routeConference = $condition->getConferenceRoom();
            $this->_routeExtension  = $condition->getExtension();
            break;
        }

        // Play locution if requested
        $this->agi->playback($locution);
        // Route this!
        $this->route();
    }

}
