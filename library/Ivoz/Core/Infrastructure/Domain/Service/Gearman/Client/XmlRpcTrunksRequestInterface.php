<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client;

interface XmlRpcTrunksRequestInterface
{
    /**
     * @param string $action
     * @param bool $delayed
     * @return void
     */
    public function send(string $action, bool $delayed = false);
}
