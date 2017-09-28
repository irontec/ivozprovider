<?php

namespace Ivoz\Ast\Domain\Model\Queue;

/**
 * Queue
 */
class Queue extends QueueAbstract implements QueueInterface
{
    use QueueTrait;

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

