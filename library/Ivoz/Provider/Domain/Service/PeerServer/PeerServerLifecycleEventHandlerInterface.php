<?php

namespace Ivoz\Provider\Domain\Service\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

interface PeerServerLifecycleEventHandlerInterface
{
    public function execute(PeerServerInterface $entity, $isNew);
}