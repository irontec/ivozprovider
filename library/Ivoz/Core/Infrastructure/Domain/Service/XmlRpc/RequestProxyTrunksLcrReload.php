<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyTrunksLcrReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyTrunksLcrReload extends AbstractXmlRpcRequest
{
    protected function getProxyServers()
    {
        return [
            'proxytrunks' => 'lcr.reload',
        ];
    }
}