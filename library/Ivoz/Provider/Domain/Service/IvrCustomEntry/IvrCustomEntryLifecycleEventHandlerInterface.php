<?php

namespace Ivoz\Provider\Domain\Service\IvrCustomEntry;

use Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface;

interface IvrCustomEntryLifecycleEventHandlerInterface
{
    public function execute(IvrCustomEntryInterface $entity, $isNew);
}