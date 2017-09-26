<?php

namespace Ivoz\Provider\Domain\Service\IvrCustom;

use Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface;

interface IvrCustomLifecycleEventHandlerInterface
{
    public function execute(IvrCustomInterface $entity, $isNew);
}