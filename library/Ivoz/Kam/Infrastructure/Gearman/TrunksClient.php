<?php

namespace Ivoz\Kam\Infrastructure\Gearman;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client\XmlRpcTrunksRequestInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Kam\Infrastructure\Kamailio\JsonRpcRequestTrait;
use Ivoz\Kam\Infrastructure\Kamailio\RpcClient;
use Psr\Log\LoggerInterface;

class TrunksClient implements TrunksClientInterface
{
    use JsonRpcRequestTrait;

    protected $rpcClient;
    protected $germanClient;
    protected $logger;

    public function __construct(
        RpcClient $rpcClient,
        XmlRpcTrunksRequestInterface $germanClient,
        LoggerInterface $logger
    ) {
        $this->rpcClient = $rpcClient;
        $this->germanClient = $germanClient;
        $this->logger = $logger;
    }

    public function reloadDialplan()
    {
        return $this->germanClient->send(
            self::DIALPLAN_RELOAD_ACTION
        );
    }

    public function reloadDispatcher()
    {
        return $this->germanClient->send(
            self::DISPATCHER_RELOAD_ACTION
        );
    }

    public function reloadLcr()
    {
        return $this->germanClient->send(
            self::LCR_RELOAD_ACTION
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

    public function reloadUacReg()
    {
        return $this->germanClient->send(
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

    public function getLcrGatewayInfo($gw_id): array
    {
        $response = $this->sendRequest(
            self::LCR_DUMP_GWS_ACTION,
            [$gw_id]
        );

        if (!isset($response->result)) {
            return [];
        }

        /**
         * Expected response format
         * {
         *   lcr_id: 1
         *   gw_id: 21
         *   gw_index: 2
         *   gw_name: b1c1s14
         *   scheme: sip:
         *   ip_addr: 0.0.0.0
         *   hostname: example.com
         *   port: 5060
         *   params:
         *   transport: ;transport=udp
         *   strip: 0
         *   prefix:
         *   tag:
         *   flags: 14
         *   state: 0
         *   defunct_until: 0
         * }
         */
        return (array) $response->result;
    }

    public function reloadRtpengine()
    {
        return $this->germanClient->send(
            self::RTPENGINE_RELOAD_ACTION
        );
    }

    /**
     * @param int $companyId
     * @return int[] inbound/outbound
     */
    public function getCompanyActiveCalls(int $companyId): array
    {
        $inbound = $this->getActiveCalls([
            'inboundCallsCompany',
            $companyId
        ]);

        $outbound = $this->getActiveCalls([
            'outboundCallsCompany',
            $companyId
        ]);

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
        $inbound = $this->getActiveCalls([
            'inboundCallsBrand',
            $brandId
        ]);

        $outbound = $this->getActiveCalls([
            'outboundCallsBrand',
            $brandId
        ]);

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
        $inbound = $this->getActiveCalls([
            'inboundCallsBrand'
        ]);

        $outbound = $this->getActiveCalls([
            'outboundCallsBrand'
        ]);

        return [
            $inbound,
            $outbound
        ];
    }

    /**
     * @param array $payload
     * @return int
     */
    private function getActiveCalls(array $payload)
    {
        $response = $this->sendRequest(
            self::DLG_PROFILE_GET_SIZE,
            $payload
        );

        if (!isset($response->result)) {
            return -1;
        }

        return $response->result;
    }

    public function isCgrEnabled()
    {
        $response = $this->sendRequest(
            self::CGRATES_ENABLED_ACTION,
            [
                'config',
                'cgrates_mode'
            ]
        );

        if (!isset($response->result)) {
            return -1;
        }

        return $response->result === 0;
    }
}
