<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternGroupLifecycleEventHandlerInterface
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
    public function execute(RoutingPatternGroupInterface $entity)
    {
        if ($entity->isNew()) {
            return;
        }

        $this->trunksClient->reloadLcr();
    }
}
