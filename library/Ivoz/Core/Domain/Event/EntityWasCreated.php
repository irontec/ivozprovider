<?php

namespace Ivoz\Core\Domain\Event;

use Ramsey\Uuid\Uuid;

class EntityWasCreated implements EntityEventInterface
{

    /**
     * @var string
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
     * @var \DateTime
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

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @return int
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return \DateTime
     */
    public function getOccurredOn()
    {
        return clone $this->occurredOn;
    }

    /**
     * @return int
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }
}
