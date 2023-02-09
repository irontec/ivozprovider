<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Graze\GuzzleHttp\JsonRpc\Message\Request;
use Graze\GuzzleHttp\JsonRpc\Message\RequestInterface;
use Graze\GuzzleHttp\JsonRpc\Message\Response;
use GuzzleHttp\Promise\Promise;

class FakeRpcClient extends RpcClient
{
    public function notification($method, array $params = null): Request
    {
        $reflection = new \ReflectionClass(
            \Graze\GuzzleHttp\JsonRpc\Message\Request::class
        );

        return $reflection->newInstanceWithoutConstructor();
    }

    public function request($id, $method, array $params = null): Request
    {
        $params =
        $params['id'] = $id;

        $body = [
            "jsonrpc" => "2.0",
            "method" => "ApierV2.SetAccount",
            'params' => [
                'id' => $id,
                'params' => [$params]
            ]
        ];

        return new Request(
            'POST',
            '/uri',
            [],
            json_encode($body, JSON_THROW_ON_ERROR)
        );
    }

    public function send(RequestInterface $request): Response
    {
        return new Response(
            200,
            [],
            '{"error": null}'
        );
    }

    public function sendAsync(RequestInterface $request): Promise
    {
        $reflection = new \ReflectionClass(
            Promise::class
        );

        return $reflection->newInstanceWithoutConstructor();
    }

    public function sendAll(array $requests)
    {
        $reflection = new \ReflectionClass(
            Response::class
        );

        return [
            $reflection->newInstanceWithoutConstructor()
        ];
    }

    public function sendAllAsync(array $requests): Promise
    {
        $reflection = new \ReflectionClass(
            Promise::class
        );

        return $reflection->newInstanceWithoutConstructor();
    }
}
