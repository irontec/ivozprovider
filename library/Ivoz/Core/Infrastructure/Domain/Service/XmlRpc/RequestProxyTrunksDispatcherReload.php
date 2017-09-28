<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyTrunksDispatcherReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyTrunksDispatcherReload extends AbstractXmlRpcRequest
{
    public function getProxyServers()
    {
        return [
            'proxytrunks' => 'dispatcher.reload',
        ];
    }
}