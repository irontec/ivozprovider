<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Graze\GuzzleHttp\JsonRpc\Message\Request;
use Graze\GuzzleHttp\JsonRpc\Message\RequestInterface;
use Graze\GuzzleHttp\JsonRpc\Message\Response;

class FakeRpcClient extends RpcClient
{
    public function notification($method, array $params = null)
    {
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
            json_encode($body)
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
