<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

interface LocutionLifecycleEventHandlerInterface
{
    public function execute(LocutionInterface $entity);
}