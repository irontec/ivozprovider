<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

interface ExtensionLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ExtensionInterface $entity, $isNew);
}