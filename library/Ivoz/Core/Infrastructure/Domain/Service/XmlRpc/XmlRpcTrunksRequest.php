<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

/**
 * Class XmlRpcTrunksRequest
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class XmlRpcTrunksRequest extends AbstractXmlRpcRequest
{
    public function __construct(
        Xmlrpc $xmlrpc,
        string $rpcMethod
    ) {
        parent::__construct(
            $xmlrpc,
            ProxyTrunk::class,
            8001,
            $rpcMethod
        );
    }

}