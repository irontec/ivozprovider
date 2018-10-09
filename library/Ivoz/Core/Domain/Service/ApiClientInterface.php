<?php

namespace Ivoz\Core\Domain\Service;

use Psr\Http\Message\ResponseInterface;

interface ApiClientInterface
{
    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function get(string $uri, array $options = []);

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function post(string $uri, array $options = []);

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function put(string $uri, array $options = []);

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function delete(string $uri, array $options = []);
}
