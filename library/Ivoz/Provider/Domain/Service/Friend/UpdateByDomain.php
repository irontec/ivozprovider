<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

/**
 * Class UpdateByCompany
 *
 * @package Ivoz\Provider\Domain\Service\Friend
 * @lifecycle post_persist
 */
class UpdateByDomain implements DomainLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    /**
     * Update Friends domain field when Domain is updated
     *
     * @param DomainInterface $entity
     */
    public function execute(DomainInterface $entity)
    {
        // Only do this for Company Domains
        $company = $entity->getCompany();
        if (!$company) {
            return;
        }

        /** @var FriendInterface[] $terminals */
        $friends = $company->getFriends();
        foreach ($friends as $friend) {
            $friend->setDomain($entity->getDomain());
            $this->entityPersister->persist($friend);
        }

    }
}
