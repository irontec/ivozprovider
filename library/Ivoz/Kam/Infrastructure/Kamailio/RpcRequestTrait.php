<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Graze\GuzzleHttp\JsonRpc\Message\Request;
use Graze\GuzzleHttp\JsonRpc\Message\Response;
use Psr\Log\LoggerInterface;

trait RpcRequestTrait
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
     * @throws \RuntimeException
     */
    private function sendRequest($method, array $payload = [], int $timeout = null): \stdClass
    {
        /** @var Request $request */
        $request = $this
            ->rpcClient
            ->request(
                1,
                $method,
                $payload
            );

        $currentTimeout = $this->getCurrentTimeout();
        if (!is_null($timeout)) {
            $this->setTimeout(
                $timeout
            );
        }

        /** @var Response $response */
        $response = $this->rpcClient->send($request);
        $stringResponse = (string) $response->getBody();
        $objectResponse = json_decode($stringResponse);

        if (!is_null($timeout)) {
            // Restore timeout
            $this->setTimeout(
                $currentTimeout
            );
        }

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

    /**
     * @param int $timeout
     */
    private function setTimeout(int $timeout)
    {
        (function () use ($timeout) {

            /** @var \GuzzleHttp\Client $client */
            $client = $this->httpClient;
            $config = $client->getConfig();
            $config['timeout'] = $timeout;

            (function () use ($config) {
                $this->config = $config;
            })->call($client);
        })->call($this->rpcClient);
    }

    private function getCurrentTimeout(): int
    {
        $response = (function () {

            /** @var \GuzzleHttp\Client $client */
            $client = $this->httpClient;
            $config = $client->getConfig();

            return $config['timeout'] ?? 0;
        })->call($this->rpcClient);

        return intval($response);
    }
}
