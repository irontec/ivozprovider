<?php

namespace Ivoz\Core\Domain\Event;

interface EntityEventInterface extends DomainEventInterface
{
    public function __construct(string $entityClass, $entityId, array $changeSet = null);

    public function getId();

    public function getEntityClass();

    public function getEntityId();

    public function getData();
}
