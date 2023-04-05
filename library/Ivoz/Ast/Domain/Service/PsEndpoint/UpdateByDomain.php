<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

class UpdateByDomain implements DomainLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityPersisterInterface $entityPersister
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(DomainInterface $domain)
    {
        /** @var FriendInterface[] $friends */
        $friends = $domain->getFriends();

        foreach ($friends as $friend) {
            if (!$friend->getFromDomain()) {
                $this->updateEndpoint($friend->getPsEndpoint(), $domain->getDomain());
            }
        }

        /** @var ResidentialDeviceInterface[] $residentialDevices */
        $residentialDevices = $domain->getResidentialDevices();

        foreach ($residentialDevices as $residentialDevice) {
            if (!$residentialDevice->getFromDomain()) {
                $this->updateEndpoint($residentialDevice->getPsEndpoint(), $domain->getDomain());
            }
        }

        /** @var TerminalInterface[] $terminals */
        $terminals = $domain->getTerminals();

        foreach ($terminals as $terminal) {
            $this->updateEndpoint(
                $terminal->getPsEndpoint(),
                $domain->getDomain()
            );
        }

        $this->entityPersister->dispatchQueued();
    }

    /**
     * @return void
     */
    private function updateEndpoint(?PsEndpointInterface $endpoint, string $fromdomain)
    {
        if (!$endpoint) {
            return;
        }

        $endpointDto = $endpoint->toDto();
        $endpointDto->setFromDomain($fromdomain);

        $this->entityPersister->persistDto($endpointDto, $endpoint);
    }
}
