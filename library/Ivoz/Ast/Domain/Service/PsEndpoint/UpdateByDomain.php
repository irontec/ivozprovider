<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

class UpdateByDomain implements DomainLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(EntityPersisterInterface $entityPersister) {
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

        /** @var RetailAccountInterface[] $retailAccounts */
        $retailAccounts = $entity->getRetailAccounts();

        foreach ($retailAccounts as $retailAccount) {
            if (!$retailAccount->getFromDomain()) {
                $this->updateEndpoint($retailAccount->getAstPsEndpoint(), $entity->getDomain());
            }
        }

        /** @var TerminalInterface[] $terminals */
        $terminals = $entity->getTerminals();

        foreach ($terminals as $terminal) {
            $this->updateEndpoint($terminal->getAstPsEndpoint(), $entity->getDomain());
        }

        $this->entityPersister->dispatchQueued();
    }

    private function updateEndpoint(PsEndpointInterface $endpoint, $fromdomain)
    {
        /** @var PsEndpointDTO $endpointDTO */
        $endpointDTO = $endpoint->toDto();
        $endpointDTO->setFromDomain($fromdomain);

        $this->entityPersister->persistDto($endpointDTO, $endpoint);
    }
}
