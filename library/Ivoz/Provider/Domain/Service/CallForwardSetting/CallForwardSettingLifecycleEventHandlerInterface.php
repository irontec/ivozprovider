<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

interface CallForwardSettingLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CallForwardSettingInterface $entity, $isNew);
}