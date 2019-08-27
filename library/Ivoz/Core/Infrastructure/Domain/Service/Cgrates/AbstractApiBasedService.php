<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;

/**
 * @deprecated Use ApiClient as a collaborator instead
 */
abstract class AbstractApiBasedService
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
     *
     * @return void
     */
    protected function sendRequest($method, array $payload)
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
    }
}
