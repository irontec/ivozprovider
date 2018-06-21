<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ConferenceRoomRepository extends ObjectRepository, Selectable {}

