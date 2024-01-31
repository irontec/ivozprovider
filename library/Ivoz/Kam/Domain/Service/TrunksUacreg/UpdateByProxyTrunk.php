<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Ivoz\Provider\Domain\Service\ProxyTrunk\ProxyTrunkLifecycleEventHandlerInterface;

class UpdateByProxyTrunk implements ProxyTrunkLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private UpdateByDdiProvider $updateByDdiProvider,
        private DdiProviderRepository $ddiProviderRepository
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

    public function execute(ProxyTrunkInterface $proxyTrunk): void
    {
        if ($proxyTrunk->isNew()) {
            return;
        }

        $proxyTrunkHasChangedIp = $proxyTrunk->hasChanged("ip") || $proxyTrunk->hasChanged("advertisedIp") ;
        if (!$proxyTrunkHasChangedIp) {
            return;
        }

        $ddiProviders = $this
            ->ddiProviderRepository
            ->findByProxyTrunks($proxyTrunk);

        if (empty($ddiProviders)) {
            return;
        }

        foreach ($ddiProviders as $ddiProvider) {
            $this->updateByDdiProvider->execute($ddiProvider);
        }
    }
}
