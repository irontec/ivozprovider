<?php

namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

interface BrandLifecycleEventHandlerInterface
{
    public function execute(BrandInterface $entity, $isNew);
}