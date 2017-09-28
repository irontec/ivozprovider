<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyTrunksUacRegReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyTrunksUacRegReload extends AbstractXmlRpcRequest
{
    protected function getProxyServers()
    {
        return [
            'proxytrunks' => 'uac.reg_reload',
        ];
    }
}