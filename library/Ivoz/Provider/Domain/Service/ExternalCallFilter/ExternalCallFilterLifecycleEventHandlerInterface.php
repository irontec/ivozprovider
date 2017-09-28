<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilter;

use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;

interface ExternalCallFilterLifecycleEventHandlerInterface
{
    public function execute(ExternalCallFilterInterface $entity);
}