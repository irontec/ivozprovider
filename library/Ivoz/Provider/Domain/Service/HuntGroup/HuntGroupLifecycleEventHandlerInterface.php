<?php

namespace Ivoz\Provider\Domain\Service\HuntGroup;

use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;

interface HuntGroupLifecycleEventHandlerInterface
{
    public function execute(HuntGroupInterface $entity);
}