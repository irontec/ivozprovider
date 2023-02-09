<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;

class QueueFullAction
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
     * @var QueueInterface|null
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

        $this->agi->notice("Processing Full queue handler");

        // Play timeout locution
        $this->agi->playbackLocution($queue->getFullLocution());

        // Route to the timeout destination
        $this->routerAction
            ->setRouteType($queue->getFullTargetType())
            ->setRouteExtension($queue->getFullExtension())
            ->setRouteVoicemail($queue->getFullVoicemail())
            ->setRouteExternal($queue->getFullNumberValueE164())
            ->route();
    }
}
