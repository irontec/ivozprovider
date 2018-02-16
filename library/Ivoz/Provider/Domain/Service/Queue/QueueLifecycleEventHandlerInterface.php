<?php

namespace Ivoz\Provider\Domain\Service\Queue;

use Ivoz\Provider\Domain\Model\Queue\QueueInterface;

interface QueueLifecycleEventHandlerInterface
{
    public function execute(QueueInterface $entity, $isNew);
}