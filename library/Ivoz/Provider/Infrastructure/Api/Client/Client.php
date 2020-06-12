<?php

namespace Ivoz\Core\Infrastructure\Service\Rest;

use GuzzleHttp\ClientInterface;
use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class Client implements ApiClientInterface
{
    protected $httpClient;
    protected $jwtTokenManager;

    protected $jwtToken;
    protected $administratorRepository;

    public function __construct(
        ClientInterface $platformHttpClient,
        JWTTokenManagerInterface $jwtTokenManager,
        AdministratorRepository $administratorRepository
    ) {
        $this->httpClient = $platformHttpClient;
        $this->jwtTokenManager = $jwtTokenManager;
        $this->administratorRepository = $administratorRepository;

        $privateAdmin = $this->administratorRepository->getInnerGlobalAdmin();
        $this->jwtToken = $this->jwtTokenManager->create(
            $privateAdmin
        );
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function get(string $uri, array $options = [])
    {
        $options = $this->appendAuthHeaders($options);

        return $this->request(
            'GET',
            $uri,
            $options
        );
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function post(string $uri, array $options = [])
    {
        $options = $this->appendAuthHeaders($options);

        return $this->request(
            'POST',
            $uri,
            $options
        );
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function put(string $uri, array $options = [])
    {
        $options = $this->appendAuthHeaders($options);

        return $this->request(
            'PUT',
            $uri,
            $options
        );
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function delete(string $uri, array $options = [])
    {
        $options = $this->appendAuthHeaders($options);

        return $this->request(
            'DELETE',
            $uri,
            $options
        );
    }

    /**
     *
     * @param string              $method  HTTP method.
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply.
     *
     * @return ResponseInterface
     * @throws \RuntimeException
     */
    protected function request($method, $uri = '', array $options)
    {
        try {
            return $this->httpClient->request(
                $method,
                $uri,
                $options
            );
        } catch (\Exception $e) {
            throw new \RuntimeException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @return array
     *
     * @psalm-return array{"headers":empty, headers:array{Authorization:string}}
     */
    private function appendAuthHeaders(array $options): array
    {
        if (!array_key_exists('headers', $options)) {
            $options['headers'] = [];
        }
        $options['headers']['Authorization'] = 'Bearer ' . $this->jwtToken;

        return $options;
    }
}
