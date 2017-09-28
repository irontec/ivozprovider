<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyTrunksDialplanReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyTrunksDialplanReload extends AbstractXmlRpcRequest
{
    protected function getProxyServers()
    {
        return [
            'proxytrunks' => 'dispatcher.reload',
        ];
    }
}