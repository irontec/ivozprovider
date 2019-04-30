<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\Client;
use Graze\GuzzleHttp\JsonRpc\Message\MessageFactory;
use GuzzleHttp\Client as HttpClient;

class CgrRpcClient extends Client
{
    /**
     * @param  string $uri
     * @param  array  $config
     *
     * @return self
     */
    public static function factory($uri, array $config = [])
    {
        if (isset($config['message_factory'])) {
            $factory = $config['message_factory'];
            unset($config['message_factory']);
        } else {
            $factory = new MessageFactory();
        }

        return new self(new HttpClient(array_merge($config, [
            'base_uri' => $uri,
        ])), $factory);
    }
}
