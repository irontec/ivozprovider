<?php

namespace Agi\Action;

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
        if (empty($this->_queue)) {
            $this->agi->error("Queue is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $queue = $this->_queue;

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
        if (empty($this->_queue)) {
            $this->agi->error("Queue is not properly defined. Check configuration.");
            return;
        }

        $this->agi->notice("Processing Timeout queue handler");

        // Local variables to improve readability
        $queue = $this->_queue;

        // Play timeout locution
        $this->agi->playback($queue->getTimeoutLocution());

        // Route to the timeout destination
        $this->_routeType       = $queue->getTimeoutTargetType();
        $this->_routeExtension  = $queue->getTimeoutExtension();
        $this->_routeVoiceMail  = $queue->getTimeoutVoiceMailUser();
        $this->_routeExternal   = $queue->getTimeoutNumberValue();
        $this->route();
    }

    public function processFull()
    {
        if (empty($this->_queue)) {
            $this->agi->error("Queue is not properly defined. Check configuration.");
            return;
        }

        $this->agi->notice("Processing Full queue handler");

        // Local variables to improve readability
        $queue = $this->_queue;

        // Play timeout locution
        $this->agi->playback($queue->getFullLocution());

        // Route to the timeout destination
        $this->_routeType       = $queue->getFullTargetType();
        $this->_routeExtension  = $queue->getFullExtension();
        $this->_routeVoiceMail  = $queue->getFullVoiceMailUser();
        $this->_routeExternal   = $queue->getFullNumberValue();
        $this->route();
    }
}
