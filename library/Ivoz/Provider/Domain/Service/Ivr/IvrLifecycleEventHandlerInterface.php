<?php

namespace Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;

interface IvrLifecycleEventHandlerInterface
{
    public function execute(IvrInterface $entity, $isNew);
}