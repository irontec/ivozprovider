<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingTag;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Service\RoutingTag\RoutingTagLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements RoutingTagLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $trunksClient;

    public function __construct(
        TrunksClientInterface $trunksClient
    ) {
        $this->trunksClient = $trunksClient;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(RoutingTagInterface $routingTag)
    {
        $this->trunksClient->reloadLcr();
    }
}
