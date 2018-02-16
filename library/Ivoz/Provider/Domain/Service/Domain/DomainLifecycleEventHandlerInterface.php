<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

interface DomainLifecycleEventHandlerInterface
{
    public function execute(DomainInterface $entity);
}