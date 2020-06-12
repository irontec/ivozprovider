<?php

namespace Ivoz\Core\Infrastructure\Service\Rest;

use GuzzleHttp\Psr7\Response;
use Ivoz\Core\Domain\Service\ApiClientInterface;
use Psr\Http\Message\ResponseInterface;

class FakeClient implements ApiClientInterface
{
    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function get(string $uri, array $options = [])
    {
        return new Response();
    }
    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function post(string $uri, array $options = [])
    {
        return new Response();
    }
    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function put(string $uri, array $options = [])
    {
        return new Response();
    }
    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function delete(string $uri, array $options = [])
    {
        return new Response();
    }
}
