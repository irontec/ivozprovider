<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Ivoz\Kam\Infrastructure\Redis\Job\UserRpcJob;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Psr\Log\LoggerInterface;

class UsersClient implements UsersClientInterface
{
    use RpcRequestTrait;

    public function __construct(
        RpcClient $rpcClient,
        private UserRpcJob $rpcJob,
        LoggerInterface $logger
    ) {
        $this->rpcClient = $rpcClient;
        $this->logger = $logger;
    }

    public function reloadDispatcher(): void
    {
        $this->rpcJob->send(
            self::DISPATCHER_RELOAD_ACTION
        );
    }

    public function reloadDomain(): void
    {
        $this->rpcJob->send(
            self::DOMAIN_RELOAD_ACTION
        );
    }

    public function reloadTrustedPermissions(): void
    {
        $this->rpcJob->send(
            self::PERMISSIONS_TRUSTED_RELOAD_ACTION
        );
    }

    public function reloadAddressPermissions(): void
    {
        $this->rpcJob->send(
            self::PERMISSIONS_ADDRESS_RELOAD_ACTION
        );
    }

    public function reloadDialplan(): void
    {
        $this->rpcJob->send(
            self::DIALPLAN_RELOAD_ACTION
        );
    }

    public function reloadRtpengine(): void
    {
        $this->rpcJob->send(
            self::RTPENGINE_RELOAD_ACTION
        );
    }

    public function unban(string $aor, string $ip): void
    {
        $this->sendRequest(
            self::BANNED_ADDRESS_UNBAN,
            [
                'srcban',
                $aor . '::' . $ip
            ],
            10
        );
    }
}
