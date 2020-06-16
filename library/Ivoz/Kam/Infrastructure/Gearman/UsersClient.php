<?php

namespace Ivoz\Kam\Infrastructure\Gearman;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client\XmlRpcUsersRequestInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Psr\Log\LoggerInterface;

class UsersClient implements UsersClientInterface
{
    protected $germanClient;
    protected $logger;

    public function __construct(
        XmlRpcUsersRequestInterface $germanClient,
        LoggerInterface $logger
    ) {
        $this->germanClient = $germanClient;
        $this->logger = $logger;
    }

    public function reloadDispatcher()
    {
        return $this->germanClient->send(
            self::DISPATCHER_RELOAD_ACTION
        );
    }

    public function reloadDomain()
    {
        return $this->germanClient->send(
            self::DOMAIN_RELOAD_ACTION
        );
    }

    public function reloadTrustedPermissions()
    {
        return $this->germanClient->send(
            self::PERMISSIONS_TRUSTED_RELOAD_ACTION
        );
    }

    public function reloadAddressPermissions()
    {
        return $this->germanClient->send(
            self::PERMISSIONS_ADDRESS_RELOAD_ACTION
        );
    }

    public function reloadDialplan()
    {
        return $this->germanClient->send(
            self::DIALPLAN_RELOAD_ACTION
        );
    }

    public function reloadRtpengine()
    {
        return $this->germanClient->send(
            self::RTPENGINE_RELOAD_ACTION
        );
    }
}
