<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyUsersDispatcherReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyUsersDispatcherReload extends AbstractXmlRpcRequest
{
    protected function getProxyServers()
    {
        return [
            'proxyusers' => 'dispatcher.reload',
        ];
    }
}