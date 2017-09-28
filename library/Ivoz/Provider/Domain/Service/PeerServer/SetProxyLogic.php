<?php

namespace Ivoz\Provider\Domain\Service\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

/**
 * Class SetProxyLogic
 * @package Ivoz\Provider\Domain\Service\PeerServer
 * @lifecycle pre_persist
 */
class SetProxyLogic implements PeerServerLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(PeerServerInterface $entity, $isNew)
    {
        $sip_proxy = explode(':', $entity->getSipProxy());
        $hostname = array_shift($sip_proxy);
        $port = array_shift($sip_proxy);

        if ($entity->getOutboundProxy()) {
            $outbound_proxy = explode(':', $entity->getOutboundProxy());
            $ip = array_shift($outbound_proxy);
            $obPort = array_shift($outbound_proxy);
            if (!is_null($port)) {
                throw new \Exception('When Outbound Proxy is used, SIP Proxy must not include a port.', 70003);
            }
            $port = $obPort;

        } else {
            $ip = null;
            $entity->setOutboundProxy(null);
        }

        if (!is_numeric($port) or !$port) {
            $port = 5060;
        }

        // Validate IP
        if (!is_null($ip) && !filter_var($ip, FILTER_VALIDATE_IP, array(FILTER_FLAG_IPV4))) {
            throw new \Exception("Outbound Proxy IP value is not valid.", 70004);
        }

        // Save validated values
        $entity->setHostname($hostname);
        $entity->setIp($ip);
        $entity->setPort($port);
    }
}