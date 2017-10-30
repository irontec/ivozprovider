<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

/**
 * ConferenceRoom
 */
class ConferenceRoom extends ConferenceRoomAbstract implements ConferenceRoomInterface
{
    use ConferenceRoomTrait;

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
}

