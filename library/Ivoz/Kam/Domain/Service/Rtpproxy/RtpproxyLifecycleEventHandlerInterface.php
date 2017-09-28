<?php

namespace Ivoz\Kam\Domain\Service\Rtpproxy;

use Ivoz\Kam\Domain\Model\Rtpproxy\RtpproxyInterface;

interface RtpproxyLifecycleEventHandlerInterface
{
    public function execute(RtpproxyInterface $entity);
}