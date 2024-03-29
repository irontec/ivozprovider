<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Ivoz\Provider\Domain\Service\DdiProvider\DdiProviderLifecycleEventHandlerInterface;

class UpdateByDdiProvider implements DdiProviderLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private SyncValuesByDdiProvider $syncValuesByDdiProvider
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @throws \Exception
     */
    public function execute(DdiProviderInterface $ddiProvider): void
    {
        if ($ddiProvider->isNew()) {
            return;
        }

        if (!$ddiProvider->hasChanged('proxyTrunkId')) {
            return;
        }

        $this->syncValuesByDdiProvider->execute($ddiProvider);
    }
}
