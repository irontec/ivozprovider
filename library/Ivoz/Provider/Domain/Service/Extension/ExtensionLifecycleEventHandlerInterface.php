<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

interface ExtensionLifecycleEventHandlerInterface
{
    public function execute(ExtensionInterface $entity, $isNew);
}