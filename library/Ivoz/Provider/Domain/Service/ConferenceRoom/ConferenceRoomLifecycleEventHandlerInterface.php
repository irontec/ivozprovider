<?php

namespace Ivoz\Provider\Domain\Service\ConferenceRoom;

use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;

interface ConferenceRoomLifecycleEventHandlerInterface
{
    public function execute(ConferenceRoomInterface $entity, $isNew);
}