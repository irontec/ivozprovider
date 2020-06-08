<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;

class ConferenceRoomAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ConferenceRoomInterface|null
     */
    protected $room;


    /**
     * ConferenceRoomAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(Wrapper $agi)
    {
        $this->agi = $agi;
    }

    /**
     * @param ConferenceRoomInterface $room
     * @return $this
     */
    public function setConferenceRoom(ConferenceRoomInterface $room = null)
    {
        $this->room = $room;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $room = $this->room;

        if (is_null($room)) {
            $this->agi->error("Conference is not properly defined. Check configuration.");
            return;
        }

        $this->agi->notice("Processing Conference Room %s", $room);

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
