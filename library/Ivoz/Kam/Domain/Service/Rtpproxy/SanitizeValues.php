<?php

namespace Ivoz\Kam\Domain\Service\Rtpproxy;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\Rtpproxy\RtpproxyInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Kam\Domain\Service\Rtpproxy
 * @lifecycle pre_persist
 */
class SanitizeValues implements RtpproxyLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(RtpproxyInterface $entity)
    {
        $entity->setSetid(
            (string) $entity->getMediaRelaySet()->getId()
        );
    }
}