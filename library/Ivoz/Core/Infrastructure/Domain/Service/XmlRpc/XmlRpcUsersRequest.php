<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

/**
 * Class XmlRpcUsersRequest
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class XmlRpcUsersRequest extends AbstractXmlRpcRequest
{
    public function __construct(
        Xmlrpc $xmlrpc,
        string $rpcMethod
    ) {
        parent::__construct(
            $xmlrpc,
            ProxyUser::class,
            8000,
            $rpcMethod
        );
    }
}