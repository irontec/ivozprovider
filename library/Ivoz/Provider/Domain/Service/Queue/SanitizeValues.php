<?php

namespace Ivoz\Provider\Domain\Service\Queue;

use Ivoz\Provider\Domain\Model\Queue\QueueInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Queue
 * @lifecycle pre_persist
 */
class SanitizeValues implements QueueLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(QueueInterface $entity, $isNew)
    {
        /**
         * @todo Check whether we can just keep zero value
         */
        // Jquery UI Spinner doesn't allow null values
        if ($entity->getMaxWaitTime() == 0) {
            $entity->setMaxWaitTime(null);
        }

        if ($entity->getMaxlen() == 0) {
            $entity->setMaxlen(null);
        }
    }
}