<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Graze\GuzzleHttp\JsonRpc\Message\Request;
use Graze\GuzzleHttp\JsonRpc\Message\Response;
use Psr\Log\LoggerInterface;

trait JsonRpcRequestTrait
{
    /**
     * @var RpcClient
     */
    protected $rpcClient;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param string $method
     * @param array $payload
     * @throws \RuntimeException
     * @return \stdClass
     */
    private function sendRequest($method, array $payload = [])
    {
        /** @var Request $request */
        $request = $this
            ->rpcClient
            ->request(
                1,
                $method,
                $payload
            );

        /** @var Response $response */
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
