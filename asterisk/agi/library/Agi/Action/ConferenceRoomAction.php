<?php

namespace Agi\Action;

class ConferenceRoomAction extends RouterAction
{
    protected $_room;

    public function setConferenceRoom($room)
    {
        $this->_room = $room;
        return $this;
    }

    public function process()
    {
        if (empty($this->_room)) {
            $this->agi->error("Conference is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $room = $this->_room;
        $this->agi->verbose("Processing Conference Room %s [conferenceRoom%s]",
                        $room->getName(), $room->getId());

        $conferenceState = $this->agi->getDeviceState($room->getId(), "confbridge:");
        $this->agi->verbose("Conference Room State = %s", $conferenceState);

        // Check if conference is already started
        if ($conferenceState == "INUSE" || $conferenceState == "RINGING") {
            // Check if conference is in this Application Server
            $conferenceCount = $this->agi->getConferenceInfo($room->getId(), "members");
            $this->agi->verbose("Conference Room member count = %d", $conferenceCount);
            if ($conferenceCount == 0) {
                // Not here!
                $this->agi->error("Conference %s [conferenceRooms%s] already started in another AS",
                                    $room->getName(), $room->getId());
                $this->agi->hangup(3);
                return;
            }
        }

        // Check if conference requires pin
        if ($room->getPinProtected()) {
            $this->agi->setConferenceSetting('user,pin', $room->getPinCode());
        }

        // Check if conference has max members
        if ($room->getMaxMembers()) {
            $this->agi->setConferenceSetting('bridge,max_members', $room->getMaxMembers());
        }

        // Redirect to Conference context
        $this->agi->redirect('call-conference', $room->getId());
    }
}
