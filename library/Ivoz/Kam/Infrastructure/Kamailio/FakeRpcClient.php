<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Graze\GuzzleHttp\JsonRpc\Message\Request;
use Graze\GuzzleHttp\JsonRpc\Message\RequestInterface;
use Graze\GuzzleHttp\JsonRpc\Message\Response;

class FakeRpcClient extends RpcClient
{
    public function notification($method, array $params = null)
    {
        $reflection = new \ReflectionClass(
            \Graze\GuzzleHttp\JsonRpc\Message\Request::class
        );

        return $reflection->newInstanceWithoutConstructor();
    }

    public function request($id, $method, array $params = null)
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
        $reflection = new \ReflectionClass(
            \GuzzleHttp\Promise\Promise::class
        );

        return $reflection->newInstanceWithoutConstructor();
    }

    public function sendAll(array $requests)
    {
        $reflection = new \ReflectionClass(
            \Graze\GuzzleHttp\JsonRpc\Message\Response::class
        );

        return [
            $reflection->newInstanceWithoutConstructor()
        ];
    }

    public function sendAllAsync(array $requests)
    {
        $reflection = new \ReflectionClass(
            \GuzzleHttp\Promise\Promise::class
        );

        return $reflection->newInstanceWithoutConstructor();
    }
}
