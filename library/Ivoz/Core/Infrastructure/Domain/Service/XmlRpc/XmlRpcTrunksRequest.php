<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc;

/**
 * Class XmlRpcTrunksRequest
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class XmlRpcTrunksRequest extends AbstractXmlRpcRequest implements XmlRpcTrunksRequestInterface
{
    public function __construct(
        Xmlrpc $xmlrpc,
        string $rpcMethod,
        bool $enabled
    ) {
        parent::__construct(
            $xmlrpc,
            ProxyTrunk::class,
            8001,
            $rpcMethod,
            $enabled
        );
    }
}
