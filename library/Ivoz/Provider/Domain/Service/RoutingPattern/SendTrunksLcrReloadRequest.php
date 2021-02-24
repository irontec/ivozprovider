<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternLifecycleEventHandlerInterface
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
    public function execute(RoutingPatternInterface $entity)
    {
        if ($entity->isNew()) {
            return;
        }

        $this->trunksClient->reloadLcr();
    }
}
