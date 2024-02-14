<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Ivoz\Provider\Domain\Service\DdiProvider\DdiProviderLifecycleEventHandlerInterface;

class SyncValuesByDdiProvider
{
    public function __construct(
        private EntityTools $entityTools,
        private ProxyTrunkRepository $proxyTrunkRepository,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(DdiProviderInterface $ddiProvider): void
    {
        $ddiProviderRegistrations = $ddiProvider->getDdiProviderRegistrations();
        $trunks = $ddiProvider->getProxyTrunk();

        if (is_null($trunks)) {
            $trunks = $this->proxyTrunkRepository->getProxyMainAddress();
        }

        foreach ($ddiProviderRegistrations as $ddiProviderRegistration) {
            $trunksUacreg = $ddiProviderRegistration->getTrunksUacreg();

            if (is_null($trunksUacreg)) {
                continue;
            }

            /** @var TrunksUacregDto $trunksUacregDto */
            $trunksUacregDto =  $this->entityTools->entityToDto($trunksUacreg);

            $trunksIp  = $trunks->getIp();
            $contactAddr  = $trunks->getAdvertisedIp()
                ? $trunks->getAdvertisedIp()
                : $trunks->getIp();

            $socket = 'udp:' . $trunksIp . ':5060';
            $contactAddr .= ':5060';

            $trunksUacregDto
                ->setSocket($socket)
                ->setContactAddr($contactAddr);

            $this->entityTools->persistDto($trunksUacregDto, $trunksUacreg);
        }
    }
}
