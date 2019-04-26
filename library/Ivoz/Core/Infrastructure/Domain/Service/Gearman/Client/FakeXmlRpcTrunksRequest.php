<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client;

class FakeXmlRpcTrunksRequest implements XmlRpcTrunksRequestInterface
{
    public function send(string $action, bool $async = false)
    {
    }
}
