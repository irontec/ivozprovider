<?php

namespace Ivoz\Core\Domain\Event;

interface EntityEventInterface extends DomainEventInterface
{
    public function __construct(string $entityClass, int $id, array $changeSet);

    public function getEntityClass();

    public function getId();

    public function getChangeSet();

    public function getOccurredOn();
}