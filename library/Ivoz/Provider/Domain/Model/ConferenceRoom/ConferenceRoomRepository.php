<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ConferenceRoomRepository extends ObjectRepository, Selectable
{

}
