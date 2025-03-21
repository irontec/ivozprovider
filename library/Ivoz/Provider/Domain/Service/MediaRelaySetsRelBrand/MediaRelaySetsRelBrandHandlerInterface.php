<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrandInterface;

interface MediaRelaySetsRelBrandHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(MediaRelaySetsRelBrandInterface $mediaRelaySetsRelBrand): void;
}
