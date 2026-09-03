<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Ivoz\Kam\Infrastructure\Redis\Job\TrunksRpcJob;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Psr\Log\LoggerInterface;

class TrunksClient implements TrunksClientInterface
{
    use RpcRequestTrait;

    const REDIS_RT_CALLS_DB = 1;
    const REDIS_SCAN_COUNT = 1000;

    /**
     * Realtime call keys are published by kamtrunks with this layout:
     *
     *   trunks:b<brandId>:c<companyId>:ddi<ddiId>:cr<carrierId>:<callId>   (outbound)
     *   trunks:b<brandId>:c<companyId>:ddi<ddiId>:dp<ddiProviderId>:<callId> (inbound)
     *
     * Every segment must be matched explicitly, so any change on the key
     * layout is caught here instead of silently returning no matches.
     */
    const INBOUND_KEY_PATTERN = 'trunks:b%s:c%s:ddi*:dp*:*';
    const OUTBOUND_KEY_PATTERN = 'trunks:b%s:c%s:ddi*:cr*:*';

    /**
     * Companion to the patterns above: extracts the owning brand and company from a matched
     * key. Every segment is spelled out here too, for the same reason, and it lives next to
     * them so a layout change is a single edit.
     */
    const KEY_OWNER_REGEXP = '/^trunks:b(\d+):c(\d+):ddi[^:]*:(?:cr|dp)[^:]*:/';

    public function __construct(
        RpcClient $rpcClient,
        private TrunksRpcJob $rpcJob,
        private RedisMasterFactory $redisMasterFactory,
        LoggerInterface $logger
    ) {
        $this->rpcClient = $rpcClient;
        $this->logger = $logger;
    }

    public function reloadDialplan(): void
    {
        $this->rpcJob->send(
            self::DIALPLAN_RELOAD_ACTION
        );
    }

    public function reloadDispatcher(): void
    {
        $this->rpcJob->send(
            self::DISPATCHER_RELOAD_ACTION
        );
    }

    public function reloadLcr(): void
    {
        $this->rpcJob->send(
            self::LCR_RELOAD_ACTION
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

    public function reloadUacReg(): void
    {
        $this->rpcJob->send(
            self::UAC_REG_RELOAD_ACTION,
            true
        );
    }

    public function getUacRegistrationInfo($luuid): array
    {
        $response = $this->sendRequest(
            self::UAC_REG_INFO_ACTION,
            ['l_uuid', $luuid]
        );

        if (!isset($response->result)) {
            return [];
        }

        /**
         * Expected response format
         * [
         *   "l_uuid" => 913512345,
         *   "l_username" => "unused",
         *   "l_domain" => "unused",
         *   "r_username" => "S201707071003224",
         *   "r_domain" => "trunksip2.domain.es",
         *   "realm" => "",
         *   "auth_username" => S201700001003224,
         *   "auth_password" => "rqf00006n02QZjy",
         *   "auth_proxy" => "sip:trunksip2.domain.es",
         *   "expires" => 3600,
         *   "flags" => 20,
         *   "diff_expires" => 938,
         *   "timer_expires" => 1567071127,
         *   "reg_init" => 1564434542,
         *   "reg_delay" => 0
         * ]
         */
        return (array) $response->result;
    }

    /**
     * @param int $gw_id
     */
    public function getLcrGatewayInfo($gw_id): array
    {
        $response = $this->sendRequest(
            self::LCR_DUMP_GWS_ACTION,
            [$gw_id],
            2
        );

        if (!isset($response->result)) {
            return [];
        }

        /** @var  \stdClass $result */
        $result = $response->result;

        if (
            !isset($result->gw)
            || !is_array($result->gw)
        ) {
            return [];
        }

        /**
         * @var array{
         *   lcr_id: int,
         *   gw_id: int,
         *   gw_index: int,
         *   gw_name: string,
         *   scheme: string,
         *   ip_addr: string,
         *   hostname: string,
         *   port: int,
         *   params: string,
         *   transport: string,
         *   strip: int,
         *   prefix: string,
         *   tag: string,
         *   flags: int,
         *   state: int,
         *   defunct_until: int,
         * }
         */
        $response = (array) $result->gw[0];

        return $response;
    }

    public function reloadRtpengine(): void
    {
        $this->rpcJob->send(
            self::RTPENGINE_RELOAD_ACTION
        );
    }

    /**
     * @return int[] inbound/outbound
     */
    public function getCompanyActiveCalls(int $brandId, int $companyId): array
    {
        $inboundFilterPattern = sprintf(
            self::INBOUND_KEY_PATTERN,
            $brandId,
            $companyId
        );
        $inbound = $this->getRedisActiveCalls($inboundFilterPattern);

        $outboundFilterPattern = sprintf(
            self::OUTBOUND_KEY_PATTERN,
            $brandId,
            $companyId
        );
        $outbound = $this->getRedisActiveCalls($outboundFilterPattern);

        return [
            $inbound,
            $outbound
        ];
    }

    /**
     * @param int $brandId
     * @return int[] inbound/outbound
     */
    public function getBrandActiveCalls(int $brandId): array
    {
        $inboundFilterPattern = sprintf(
            self::INBOUND_KEY_PATTERN,
            $brandId,
            '*'
        );
        $inbound = $this->getRedisActiveCalls($inboundFilterPattern);

        $outboundFilterPattern = sprintf(
            self::OUTBOUND_KEY_PATTERN,
            $brandId,
            '*'
        );
        $outbound = $this->getRedisActiveCalls($outboundFilterPattern);

        return [
            $inbound,
            $outbound
        ];
    }

    /**
     * @return int[]
     */
    public function getPlatformActiveCalls(): array
    {
        $inboundFilterPattern = sprintf(
            self::INBOUND_KEY_PATTERN,
            '*',
            '*'
        );
        $inbound = $this->getRedisActiveCalls($inboundFilterPattern);

        $outboundFilterPattern = sprintf(
            self::OUTBOUND_KEY_PATTERN,
            '*',
            '*'
        );
        $outbound = $this->getRedisActiveCalls($outboundFilterPattern);

        return [
            $inbound,
            $outbound
        ];
    }

    /**
     * @return array<int, array{brandId: int, occ: int}>
     */
    public function getActiveCallsGroupedByCompany(): array
    {
        $grouped = [];

        foreach ([self::INBOUND_KEY_PATTERN, self::OUTBOUND_KEY_PATTERN] as $keyPattern) {
            $filterPattern = sprintf(
                $keyPattern,
                '*',
                '*'
            );

            $this->groupRedisActiveCallsByCompany($filterPattern, $grouped);
        }

        return $grouped;
    }

    /**
     * @param array<int, array{brandId: int, occ: int}> $grouped
     */
    private function groupRedisActiveCallsByCompany(string $filterPattern, array &$grouped): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                self::REDIS_RT_CALLS_DB
            );

            /** @var int|null $redisScanIterator */
            $redisScanIterator = null;

            while (true) {
                $keys = $redisClient->scan(
                    $redisScanIterator,
                    $filterPattern,
                    self::REDIS_SCAN_COUNT
                );

                if (!is_array($keys)) {
                    break;
                }

                foreach ($keys as $key) {
                    $owner = [];
                    if (!preg_match(self::KEY_OWNER_REGEXP, (string) $key, $owner)) {
                        continue;
                    }

                    $brandId = (int) $owner[1];
                    $companyId = (int) $owner[2];

                    if (!isset($grouped[$companyId])) {
                        $grouped[$companyId] = [
                            'brandId' => $brandId,
                            'occ' => 0
                        ];
                    }

                    $grouped[$companyId]['occ']++;
                }

                if ($redisScanIterator === 0) {
                    break;
                }
            }

            $redisClient->close();
        } catch (\Exception $e) {
            $classMethod = substr(
                __METHOD__,
                (int) strrpos(__METHOD__, '\\') + 1
            );

            $this
                ->logger
                ->error(
                    sprintf(
                        '%s(%s): %s',
                        $classMethod,
                        $filterPattern,
                        $e->getMessage()
                    )
                );
        }
    }

    /**
     * @param string $filterPattern
     * @return int
     */
    private function getRedisActiveCalls(string $filterPattern)
    {
        $callNum = 0;
        try {
            $redisClient = $this->redisMasterFactory->create(
                self::REDIS_RT_CALLS_DB
            );

            /** @var int|null $redisScanIterator */
            $redisScanIterator = null;

            while (true) {
                $keys = $redisClient->scan(
                    $redisScanIterator,
                    $filterPattern,
                    self::REDIS_SCAN_COUNT
                );

                if (!is_array($keys)) {
                    break;
                }

                $callNum += count($keys);
                if ($redisScanIterator === 0) {
                    break;
                }
            }

            $redisClient->close();
        } catch (\Exception $e) {
            $classMethod = substr(
                __METHOD__,
                (int) strrpos(__METHOD__, '\\') + 1
            );

            $erroMsg = sprintf(
                '%s(%s): %s',
                $classMethod,
                $filterPattern,
                $e->getMessage()
            );

            $this
                ->logger
                ->error(
                    $erroMsg
                );
        }

        return $callNum;
    }

    public function isCgrEnabled(): bool
    {
        $response = $this->sendRequest(
            self::CGRATES_ENABLED_ACTION,
            [
                'config',
                'cgrates_mode'
            ]
        );

        if (!isset($response->result)) {
            return false;
        }

        return $response->result === 0;
    }
}
