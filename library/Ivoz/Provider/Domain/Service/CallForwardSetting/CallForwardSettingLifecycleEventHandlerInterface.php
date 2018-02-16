<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

interface CallForwardSettingLifecycleEventHandlerInterface
{
    public function execute(CallForwardSettingInterface $entity, $isNew);
}