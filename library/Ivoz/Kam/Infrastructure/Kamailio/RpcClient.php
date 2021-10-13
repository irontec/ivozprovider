<?php

namespace Ivoz\Kam\Infrastructure\Kamailio;

use Graze\GuzzleHttp\JsonRpc\Client;
use Graze\GuzzleHttp\JsonRpc\Message\MessageFactory;
use GuzzleHttp\Client as HttpClient;

class RpcClient extends Client
{
    /**
     * @param  string $uri
     */
    public static function factory($uri, array $config = []): static
    {
        if (isset($config['message_factory'])) {
            $factory = $config['message_factory'];
            unset($config['message_factory']);
        } else {
            $factory = new MessageFactory();
        }

        return new static(
            new HttpClient(
                array_merge(
                    $config,
                    ['base_uri' => $uri,]
                )
            ),
            $factory
        );
    }
}
