<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyUsersDomainReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyUsersDomainReload extends AbstractXmlRpcRequest
{
    protected function getProxyServers()
    {
        return [
            'proxyusers' => "domain.reload",
        ];
    }
}