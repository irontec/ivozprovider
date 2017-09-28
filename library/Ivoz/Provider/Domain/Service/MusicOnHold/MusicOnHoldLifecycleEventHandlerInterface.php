<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

interface MusicOnHoldLifecycleEventHandlerInterface
{
    public function execute(MusicOnHoldInterface $entity);
}