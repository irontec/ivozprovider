<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client\XmlRpcTrunksRequestInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Psr\Log\LoggerInterface;

class TrunksClient implements TrunksClientInterface
{
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

    public function reloadRtpengine()
    {
        return $this->germanClient->send(
            self::RTPENGINE_RELOAD_ACTION
        );
    }

    /**
     * @param int $companyId
     * @return int
     */
    public function getCompanyActiveCalls(int $companyId)
    {
        $payload = ['activeCallsCompany'];
        if (!is_null($companyId)) {
            $payload[] = $companyId;
        }

        return $this->getActiveCalls($payload);
    }

    /**
     * @param int $brandId
     * @return int
     */
    public function getBrandActiveCalls(int $brandId)
    {
        $payload = ['activeCallsBrand'];
        if (!is_null($brandId)) {
            $payload[] = $brandId;
        }

        return $this->getActiveCalls($payload);
    }

    /**
     * @return int
     */
    public function getPlatformActiveCalls()
    {
        return $this->getActiveCalls([
            'activeCallsBrand'
        ]);
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

    /**
     * @param string $method
     * @param array $payload
     * @throws \RuntimeException
     * @return \stdClass
     */
    private function sendRequest($method, array $payload = [])
    {
        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Request $request */
        $request = $this
            ->rpcClient
            ->request(
                1,
                $method,
                $payload
            );

        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $response */
        $response = $this->rpcClient->send($request);
        $stringResponse = (string) $response->getBody();
        $objectResponse = json_decode($stringResponse);

        if ($response->getRpcErrorCode()) {
            $errorMsg = sprintf(
                'Trunks API response error: %s',
                $response->getRpcErrorMessage()
            );

            $this->logger->error($errorMsg);
            throw new \RuntimeException($errorMsg);
        }

        return $objectResponse;
    }
}
