<?php

namespace Ivoz\Provider\Domain\Service\PeerServer;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

interface PeerServerLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(PeerServerInterface $entity, $isNew);
}