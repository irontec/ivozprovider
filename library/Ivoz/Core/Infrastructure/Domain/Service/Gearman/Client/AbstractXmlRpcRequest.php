<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc;

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

    /**
     * @var bool
     */
    protected $enabled;

    public function __construct(
        Xmlrpc $xmlrpc,
        string $rpcEntity,
        int $rpcPort,
        bool $enabled
    ) {
        $this->xmlrpc = $xmlrpc;
        $this->xmlrpc->setRpcEntity($rpcEntity);
        $this->xmlrpc->setRpcPort($rpcPort);

        $this->enabled = $enabled;
    }

    /**
     * @return void
     */
    public function send(string $rpcMethod)
    {
        if (!$this->enabled) {
            return;
        }

        $this->xmlrpc->setRpcMethod($rpcMethod);
        $this->xmlrpc->send();
    }
}
