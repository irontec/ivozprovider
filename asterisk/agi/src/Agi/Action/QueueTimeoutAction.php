<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;

class QueueTimeoutAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var QueueInterface
     */
    protected $queue;

    /**
     * QueueAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
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

        $this->agi->notice("Processing Timeout queue handler");

        // Play timeout locution
        $this->agi->playbackLocution($queue->getTimeoutLocution());

        // Route to the timeout destination
        $this->routerAction
            ->setRouteType($queue->getTimeoutTargetType())
            ->setRouteExtension($queue->getTimeoutExtension())
            ->setRouteVoicemail($queue->getTimeoutVoiceMailUser())
            ->setRouteExternal($queue->getTimeoutNumberValueE164())
            ->route();
    }
}
