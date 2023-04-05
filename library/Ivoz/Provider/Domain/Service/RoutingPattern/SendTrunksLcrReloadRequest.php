<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
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
    public function execute(RoutingPatternInterface $routingPattern)
    {
        if ($routingPattern->isNew()) {
            return;
        }

        $this->trunksClient->reloadLcr();
    }
}
