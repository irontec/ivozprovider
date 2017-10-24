<?php

namespace Agi\Action;

use Assert\Assertion;


class QueueAction extends RouterAction
{
    protected $_queue;

    public function setQueue($queue)
    {
        $this->_queue = $queue;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $queue = $this->_queue;
        Assertion::notNull(
            $queue,
            "Queue is not properly defined. Check configuration."
        );

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

    public function processTimeout()
    {
        // Local variables to improve readability
        $queue = $this->_queue;
        Assertion::notNull(
            $queue,
            "Queue is not properly defined. Check configuration."
        );

        $this->agi->notice("Processing Timeout queue handler");

        // Play timeout locution
        $this->agi->playback($queue->getTimeoutLocution());

        // Route to the timeout destination
        $this->_routeType       = $queue->getTimeoutTargetType();
        $this->_routeExtension  = $queue->getTimeoutExtension();
        $this->_routeVoiceMail  = $queue->getTimeoutVoiceMailUser();
        $this->_routeExternal   = $queue->getTimeoutNumberValueE164();
        $this->route();
    }

    public function processFull()
    {
        // Local variables to improve readability
        $queue = $this->_queue;
        Assertion::notNull(
            $queue,
            "Queue is not properly defined. Check configuration."
        );

        $this->agi->notice("Processing Full queue handler");

        // Play timeout locution
        $this->agi->playback($queue->getFullLocution());

        // Route to the timeout destination
        $this->_routeType       = $queue->getFullTargetType();
        $this->_routeExtension  = $queue->getFullExtension();
        $this->_routeVoiceMail  = $queue->getFullVoiceMailUser();
        $this->_routeExternal   = $queue->getFullNumberValueE164();
        $this->route();
    }
}
