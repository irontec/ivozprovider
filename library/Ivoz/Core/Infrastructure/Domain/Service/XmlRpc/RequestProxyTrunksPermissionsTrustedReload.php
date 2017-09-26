<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\XmlRpc;

/**
 * Class RequestProxyTrunksPermissionsTrustedReload
 * @package Ivoz\Core\Infrastructure\Service\XmlRpc
 */
class RequestProxyTrunksPermissionsTrustedReload extends AbstractXmlRpcRequest
{
    protected function getProxyServers()
    {
        return [
            'proxytrunks' => "permissions.trustedReload",
        ];
    }
}