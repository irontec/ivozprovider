<?php

namespace Ivoz\Core\Domain\Event;

class EntityWasCreated implements DomainEventInterface
{
    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var array
     */
    protected $changeSet;

    /**
     * @var \DateTimeImmutable
     */
    protected $occurredOn;

    public function __construct(
        string $entityClass,
        /** @todo not nullable */
        $id = null,
        array $changeSet
    ) {
        $this->entityClass = $entityClass;
        $this->id = $id;
        $this->changeSet = $changeSet;

        $this->occurredOn = new \DateTimeImmutable(
            'now',
            new \DateTimeZone('UTC')
        );
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getChangeSet()
    {
        return $this->changeSet;
    }

    public function getOccurredOn()
    {
        return $this->occurredOn;
    }
}