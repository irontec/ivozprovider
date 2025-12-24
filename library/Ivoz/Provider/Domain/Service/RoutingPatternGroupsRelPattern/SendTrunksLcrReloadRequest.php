<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    /** @var array<int, bool> */
    private static array $processedGroups = [];

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(RoutingPatternGroupsRelPatternInterface $relPattern)
    {
        $routingPatternGroup = $relPattern->getRoutingPatternGroup();
        if ($routingPatternGroup === null) {
            return;
        }

        $groupId = $routingPatternGroup->getId();
        if ($groupId === null) {
            return;
        }

        if (isset(self::$processedGroups[$groupId])) {
            return;
        }

        $outgoingRoutings = $routingPatternGroup->getOutgoingRoutings();

        if (count($outgoingRoutings) === 0) {
            return;
        }

        self::$processedGroups[$groupId] = true;
        $this->trunksClient->reloadLcr();
    }
}
