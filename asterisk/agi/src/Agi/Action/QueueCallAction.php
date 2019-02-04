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
     * @var QueueMemberInterface
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

        $user = $queueMember->getUser();
        if (is_null($user)) {
            $this->agi->error("No user found for queue member %s", $queueMember);
            return;
        }

        $endpoint = $user->getEndpoint();
        if (is_null($endpoint)) {
            $this->agi->error("User %s has no endpoint associated", $user);
            return;
        }

        $this->agi->setVariable("DIAL_OPTS", "ic");
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $endpoint->getSorceryId());
    }
}
