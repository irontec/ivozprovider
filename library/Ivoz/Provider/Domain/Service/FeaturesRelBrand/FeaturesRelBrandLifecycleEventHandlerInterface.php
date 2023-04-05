<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;

interface FeaturesRelBrandLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(FeaturesRelBrandInterface $relBrand);
}
