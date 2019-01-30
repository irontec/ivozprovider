<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;

class QueueAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var QueueInterface
     */
    protected $queue;

    /**
     * QueueAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    ) {
        $this->agi = $agi;
    }

    /**
     * @param QueueInterface|null $queue
     * @return $this
     */
    public function setQueue(QueueInterface $queue = null)
    {
        $this->queue = $queue;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $queue = $this->queue;

        if (is_null($queue)) {
            $this->agi->error("Queue is not properly defined. Check configuration.");
            return;
        }

        // Set queue options
        $this->agi->setVariable("QUEUE", $queue->getAstQueueName());
        $this->agi->setVariable("QUEUE_ID", $queue->getId());

        // Max time in queue (Note: zero does NOT mean infinite)
        if ($queue->getMaxWaitTime() > 0) {
            $this->agi->setVariable("QUEUE_TIMEOUT", $queue->getMaxWaitTime());
        }

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-queue');
    }
}
