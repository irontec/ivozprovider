<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

interface FaxesInOutLifecycleEventHandlerInterface
{
    public function execute(FaxesInOutInterface $entity);
}