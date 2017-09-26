<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

use IvozProvider\Gearmand\Jobs\Xmlrpc;

/**
 * Class AbstractXmlRpcRequest
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
abstract class AbstractXmlRpcRequest
{
    /**
     * @var Xmlrpc
     */
    protected $xmlrpc;

    public function __construct(
        Xmlrpc $xmlrpc
    ) {
        $this->xmlrpc = $xmlrpc;
    }

    protected abstract function getProxyServers();

    public function send()
    {
        $this->xmlrpc->setProxyServers(
            $this->getProxyServers()
        );
        $this->xmlrpc->send();
    }
}