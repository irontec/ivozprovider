<?php

namespace Ivoz\Provider\Domain\Service\Queue;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;

interface QueueLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(QueueInterface $entity, $isNew);
}