<?php

namespace Ivoz\Ast\Domain\Model\Queue;

/**
 * Queue
 */
class Queue extends QueueAbstract implements QueueInterface
{
    use QueueTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}

