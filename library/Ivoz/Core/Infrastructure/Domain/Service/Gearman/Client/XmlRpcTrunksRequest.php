<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Client;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\AbstractJob;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

class XmlRpcTrunksRequest extends AbstractXmlRpcRequest implements XmlRpcTrunksRequestInterface
{
    public function __construct(
        Xmlrpc $xmlrpc,
        bool $enabled
    ) {
        parent::__construct(
            $xmlrpc,
            ProxyTrunk::class,
            8001,
            $enabled
        );
    }

    public function send(string $action, bool $delayed = false)
    {
        if (!in_array($action, TrunksClientInterface::TRUNKS_ACTIONS, true)) {
            throw new \RuntimeException('Unexpected method ' . $action);
        }

        $method = $delayed
            ? AbstractJob::DELAYED_METHOD
            : AbstractJob::INMEDIATE_METHOD;

        $this->xmlrpc->setMethod($method);

        parent::send($action);
    }
}
