<?php

namespace Agi\Action;

use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Assert\Assertion;

class ConferenceRoomAction extends RouterAction
{
    /**
     * @var ConferenceRoomInterface
     */
    protected $_room;

    public function setConferenceRoom($room)
    {
        $this->_room = $room;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $room = $this->_room;
        Assertion::notNull(
            $room,
            "Conference is not properly defined. Check configuration."
        );

        $this->agi->notice("Processing Conference Room %s [conferenceRoom%s]",
                        $room->getName(), $room->getId());

        // We're connecting this conference
        $this->agi->setConnectedLine('name', $room->getName());

        // Check if conference requires pin
        if ($room->getPinProtected()) {
            $this->agi->setConferenceSetting('user,pin', $room->getPinCode());
        }

        // Check if conference has max members
        if ($room->getMaxMembers()) {
            $this->agi->setConferenceSetting('bridge,max_members', $room->getMaxMembers());
        }

        // Enable video support
        $this->agi->setConferenceSetting('bridge,video_mode', 'follow_talker');

        // Redirect to Conference context
        $this->agi->redirect('call-conference', $room->getId());
    }
}
