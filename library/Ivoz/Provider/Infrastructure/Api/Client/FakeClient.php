<?php

namespace Ivoz\Provider\Infrastructure\Api\Client;

use GuzzleHttp\Psr7\Response;
use Ivoz\Core\Domain\Service\ApiClientInterface;
use Psr\Http\Message\ResponseInterface;

class FakeClient implements ApiClientInterface
{
    public function get(string $uri, array $options = []): Response
    {
        return new Response();
    }

    public function post(string $uri, array $options = []): Response
    {
        return new Response();
    }

    public function put(string $uri, array $options = []): Response
    {
        return new Response();
    }

    public function delete(string $uri, array $options = []): Response
    {
        return new Response();
    }
}
