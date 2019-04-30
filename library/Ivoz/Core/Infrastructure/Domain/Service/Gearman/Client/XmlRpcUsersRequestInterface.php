<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client;

interface XmlRpcUsersRequestInterface
{
    /**
     * @return void
     */
    public function send(string $action);
}
