<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

/**
 * Class UpdateByCompany
 *
 * @package Ivoz\Provider\Domain\Service\Terminal
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
     * Update Terminals domain field when Domain is updated
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

        /** @var TerminalInterface[] $terminals */
        $terminals = $company->getTerminals();
        foreach ($terminals as $terminal) {
            $terminal->setDomain($entity->getDomain());
            $this->entityPersister->persist($terminal);
        }
    }
}
