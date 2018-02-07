<?php

namespace Ivoz\Kam\Domain\Service\PikeTrusted;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;

/**
 * Class SanitizeValues
 * @lifecycle pre_persist
 */
class CheckValidity implements PikeTrustedLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(PikeTrustedInterface $entity)
    {
        $ip = $entity->getSrcIp();

        // Validate IP
        if (!filter_var($ip, FILTER_VALIDATE_IP, array(FILTER_FLAG_IPV4))) {
            throw new \DomainException('Invalid IP address, discarding value.', 70000);
        }

        $entity->setProto('any');
    }
}