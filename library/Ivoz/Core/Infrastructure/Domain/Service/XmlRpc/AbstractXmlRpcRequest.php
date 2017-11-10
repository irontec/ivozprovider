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
        Xmlrpc $xmlrpc,
        string $rpcEntity,
        int $rpcPort,
        string $rpcMethod
    ) {
        $this->xmlrpc = $xmlrpc;
        $this->xmlrpc->setRpcEntity($rpcEntity);
        $this->xmlrpc->setRpcPort($rpcPort);
        $this->xmlrpc->setRpcMethod($rpcMethod);
    }

    public function send()
    {
        $this->xmlrpc->send();
    }
}