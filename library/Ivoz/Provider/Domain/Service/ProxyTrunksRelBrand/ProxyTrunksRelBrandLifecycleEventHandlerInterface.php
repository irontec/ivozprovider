<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface;

interface ProxyTrunksRelBrandLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ProxyTrunksRelBrandInterface $relBrand);
}
