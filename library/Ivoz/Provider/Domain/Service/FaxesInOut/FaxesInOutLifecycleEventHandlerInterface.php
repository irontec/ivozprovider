<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

interface FaxesInOutLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(FaxesInOutInterface $entity);
}