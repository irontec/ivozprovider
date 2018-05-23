<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

interface LocutionLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(LocutionInterface $entity);
}