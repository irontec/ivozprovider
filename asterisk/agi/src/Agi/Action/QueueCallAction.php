<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;

class QueueCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var QueueMemberInterface|null
     */
    protected $queueMember;

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
     * @param QueueMemberInterface|null $queueMember
     * @return $this
     */
    public function setQueueMember(QueueMemberInterface $queueMember = null)
    {
        $this->queueMember = $queueMember;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $queueMember = $this->queueMember;
        if (is_null($queueMember)) {
            $this->agi->error("Queue is not properly defined. Check configuration.");
            return;
        }

        $queue = $queueMember->getQueue();
        $user = $queueMember->getUser();

        $endpoint = $user->getEndpoint();
        if (is_null($endpoint)) {
            $this->agi->error("User %s has no endpoint associated", $user);
            return;
        }

        $dnd = $user->getDoNotDisturb();
        if ($dnd) {
            $this->agi->verbose("User %s has DND enabled.", $user);
            return;
        }

        // Configure Dial options
        $options = "i";

        // Cancelled calls may be marked as 'answered elsewhere'
        $queuePreventMissedCalls = $queue->getPreventMissedCalls();
        if ($queuePreventMissedCalls) {
            $options .= "c";
        }

        $this->agi->setVariable("DIAL_OPTS", $options);
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $endpoint->getSorceryId());
    }
}
