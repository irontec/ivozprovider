<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

class UpdateByDomain implements DomainLifecycleEventHandlerInterface
{
    /**
     * @todo replace by EntityTools
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(EntityPersisterInterface $entityPersister)
    {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(DomainInterface $entity)
    {
        /** @var FriendInterface[] $friends */
        $friends = $entity->getFriends();

        foreach ($friends as $friend) {
            if (!$friend->getFromDomain()) {
                $this->updateEndpoint($friend->getAstPsEndpoint(), $entity->getDomain());
            }
        }

        /** @var ResidentialDeviceInterface[] $residentialDevices */
        $residentialDevices = $entity->getResidentialDevices();

        foreach ($residentialDevices as $residentialDevice) {
            if (!$residentialDevice->getFromDomain()) {
                $this->updateEndpoint($residentialDevice->getAstPsEndpoint(), $entity->getDomain());
            }
        }

        /** @var TerminalInterface[] $terminals */
        $terminals = $entity->getTerminals();

        foreach ($terminals as $terminal) {
            $this->updateEndpoint(
                $terminal->getAstPsEndpoint(),
                $entity->getDomain()
            );
        }

        $this->entityPersister->dispatchQueued();
    }

    private function updateEndpoint(PsEndpointInterface $endpoint, $fromdomain)
    {
        /** @var PsEndpointDto $endpointDto */
        $endpointDto = $endpoint->toDto();
        $endpointDto->setFromDomain($fromdomain);

        $this->entityPersister->persistDto($endpointDto, $endpoint);
    }
}
