<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc;

/**
 * Class XmlRpcUsersRequest
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class XmlRpcUsersRequest extends AbstractXmlRpcRequest
{
    public function __construct(
        Xmlrpc $xmlrpc,
        string $rpcMethod,
        bool $enabled
    ) {
        parent::__construct(
            $xmlrpc,
            ProxyUser::class,
            8000,
            $rpcMethod,
            $enabled
        );
    }
}
