<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;

/**
 * Class SanitizeValues
 * @lifecycle pre_persist
 */
class CheckValidity implements TrustedLifecycleEventHandlerInterface
{
    public function __construct() {}

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => 10
        ];
    }

    public function execute(TrustedInterface $entity)
    {
        $ip = $entity->getSrcIp();

        // Validate IP
        if (!filter_var($ip, FILTER_VALIDATE_IP, array(FILTER_FLAG_IPV4))) {
            throw new \DomainException('Invalid IP address, discarding value.', 70000);
        }

        $entity->setProto('any');
    }
}