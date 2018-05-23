<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

interface MusicOnHoldLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(MusicOnHoldInterface $entity);
}