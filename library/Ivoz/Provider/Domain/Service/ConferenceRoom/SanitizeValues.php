<?php

namespace Ivoz\Provider\Domain\Service\ConferenceRoom;

use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;


/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\ConferenceRoom
 * @lifecycle pre_persist
 */
class SanitizeValues implements ConferenceRoomLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(ConferenceRoomInterface $entity, $isNew)
    {
        if (!$entity->getPinProtected()) {
            $entity->setPinCode(null);
        }
    }
}