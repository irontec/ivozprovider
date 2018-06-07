<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

interface DomainLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DomainInterface $entity);
}