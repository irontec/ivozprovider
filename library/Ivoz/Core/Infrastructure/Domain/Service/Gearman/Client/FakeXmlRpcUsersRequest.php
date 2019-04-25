<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client;

class FakeXmlRpcUsersRequest implements XmlRpcUsersRequestInterface
{
    public function send(string $action)
    {
    }
}
