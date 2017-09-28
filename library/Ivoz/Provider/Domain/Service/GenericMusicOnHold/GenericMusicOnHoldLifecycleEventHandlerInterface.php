<?php

namespace Ivoz\Provider\Domain\Service\GenericMusicOnHold;

use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;

interface GenericMusicOnHoldLifecycleEventHandlerInterface
{
    public function execute(GenericMusicOnHoldInterface $entity);
}