<?php

namespace Ivoz\Provider\Domain\Model\Queue;

/**
 * Queue
 */
class Queue extends QueueAbstract implements QueueInterface
{
    use QueueTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAstQueueName()
    {
        return sprintf("b%dc%dq%d_%s",
            $this->getCompany()->getBrand()->getId(),
            $this->getCompany()->getId(),
            $this->getId(),
            $this->getName()
        );

    }
}

