<?php

namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

interface BrandLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(BrandInterface $brand);
}
