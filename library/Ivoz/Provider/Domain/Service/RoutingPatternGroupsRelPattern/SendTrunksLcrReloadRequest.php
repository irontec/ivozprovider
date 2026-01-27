<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
    }

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(RoutingPatternGroupsRelPatternInterface $relPattern): void
    {
        $routingPatternGroup = $relPattern->getRoutingPatternGroup();
        if ($routingPatternGroup === null) {
            return;
        }

        $outgoingRoutings = $routingPatternGroup->getOutgoingRoutings();

        if (count($outgoingRoutings) === 0) {
            return;
        }

        $this->trunksClient->reloadLcr();
    }
}
