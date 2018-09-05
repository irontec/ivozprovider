<?php

namespace Ivoz\Core\Domain\Event;

use Ramsey\Uuid\Uuid;

class EntityWasCreated implements EntityEventInterface
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var int
     */
    protected $entityId;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \DateTimeImmutable
     */
    protected $occurredOn;

    /**
     * @var int
     */
    protected $microtime;

    public function __construct(
        string $entityClass,
        $entityId,
        array $data = null
    ) {
        $this->entityClass = $entityClass;
        $this->entityId = $entityId;
        $this->data = $data;

        $this->id = Uuid::uuid4()->toString();
        $this->occurredOn = new \DateTime(
            'now',
            new \DateTimeZone('UTC')
        );

        $this->microtime = intval((microtime(true) - time()) * 10000);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getOccurredOn()
    {
        return $this->occurredOn;
    }

    public function getMicrotime()
    {
        return $this->microtime;
    }
}
