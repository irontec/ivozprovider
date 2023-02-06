<?php

namespace Ivoz\Kam\Domain\Service\Rtpengine;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\Rtpengine\RtpengineInterface;

interface RtpengineLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RtpengineInterface $rtpengine);
}
