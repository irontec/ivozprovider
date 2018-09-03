<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

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
        string $rpcMethod,
        bool $enabled
    ) {
        $this->xmlrpc = $xmlrpc;
        $this->xmlrpc->setRpcEntity($rpcEntity);
        $this->xmlrpc->setRpcPort($rpcPort);
        $this->xmlrpc->setRpcMethod($rpcMethod);

        $this->enabled = $enabled;
    }

    public function send()
    {
        if (!$this->enabled) {
            return;
        }

        $this->xmlrpc->send();
    }
}
