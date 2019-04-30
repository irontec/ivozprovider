<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Graze\GuzzleHttp\JsonRpc\Message\RequestInterface;
use Graze\GuzzleHttp\JsonRpc\Message\Response;
use Graze\GuzzleHttp\JsonRpc\Message\Request;

class FakeCgrRpcClient implements ClientInterface
{
    public function notification($method, array $params = null)
    {
    }

    public function request($id, $method, array $params = null)
    {
        return new Request(
            'POST',
            '/uri',
            [],
            '[]'
        );
    }

    public function send(RequestInterface $request)
    {
        return new Response(
            200,
            [],
            '{"error": null}'
        );
    }

    public function sendAsync(RequestInterface $request)
    {
    }

    public function sendAll(array $requests)
    {
    }

    public function sendAllAsync(array $requests)
    {
    }
}
