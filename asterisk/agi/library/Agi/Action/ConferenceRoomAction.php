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

        // Send X-Info-Conf to the proxy
        $this->agi->setVariable("_CONFERENCE_ID", $room->getId());
        $this->agi->setVariable("_CONFERENCE_LANG", $this->agi->getVariable("CHANNEL(language)"));

        // We're connecting this conference
        $this->agi->setConnectedLine('name', $room->getName());

        // Redirect to Conference context
        $this->agi->redirect('call-conference', $this->agi->getExtension());
    }
}
