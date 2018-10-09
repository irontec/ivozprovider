<?php

namespace Ivoz\Core\Infrastructure\Service\Rest;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Psr\Http\Message\ResponseInterface;

class FakeClient implements ApiClientInterface
{
    public function __construct()
    {
    }

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
