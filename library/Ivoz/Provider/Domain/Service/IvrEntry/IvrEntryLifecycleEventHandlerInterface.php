<?php

namespace Ivoz\Provider\Domain\Service\IvrEntry;

use Ivoz\Provider\Domain\Model\IvrEntry\IvrExcludedExtensionInterface;

interface IvrEntryLifecycleEventHandlerInterface
{
    public function execute(IvrExcludedExtensionInterface $entity, $isNew);
}