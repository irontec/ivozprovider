<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;

class ApiClient
{
    protected $jsonRpcClient;

    public function __construct(
        ClientInterface $jsonRpcClient
    ) {
        $this->jsonRpcClient = $jsonRpcClient;
    }

    /**
     * @param string $method
     * @param array $payload
     * @throws \DomainException
     * @return \stdClass
     */
    public function sendRequest($method, array $payload)
    {
        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Request $request */
        $request = $this->jsonRpcClient
            ->request(
                1,
                $method,
                [$payload]
            );

        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $response */
        $response = $this->jsonRpcClient->send($request);
        $stringResponse = $response->getBody()->__toString();
        $objectResponse = json_decode($stringResponse);

        if (isset($objectResponse->error) && $objectResponse->error) {
            $errorMsg = sprintf(
                'CgRates API error response:  %s',
                $objectResponse->error
            );
            throw new \RuntimeException($errorMsg);
        }

        return $objectResponse;
    }
}
