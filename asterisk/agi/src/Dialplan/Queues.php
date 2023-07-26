<?php

namespace Dialplan;

use Agi\Action\QueueCallAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMember;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberRepository;
use RouteHandlerAbstract;

class Queues extends RouteHandlerAbstract
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var QueueCallAction
     */
    protected $queueCallAction;

    /**
     * Queues constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param QueueCallAction $queueCallAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        QueueCallAction $queueCallAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->queueCallAction = $queueCallAction;
    }

    /**
     * @brief Outgoing calls from queues
     */
    public function process()
    {
        // Screen Extension for Queue Member
        $extension = $this->agi->getExtension();

        // Current Queue ID
        $queueId = $this->agi->getVariable("QUEUE_ID");

        /** @var QueueMemberRepository $queueMemberRepository */
        $queueMemberRepository = $this->em->getRepository(QueueMember::class);

        /** @var QueueMemberInterface|null $queueMember */
        $queueMember = $queueMemberRepository->findOneByQueueAndExtension(
            (int) $queueId,
            (int) $extension,
        );

        if (is_null($queueMember)) {
            $this->agi->error("Queue member with extension %d does not exists in queue %d.", $extension, $queueId);
            return;
        }

        // Prepate to call the queue member
        $this->queueCallAction
            ->setQueueMember($queueMember)
            ->process();
    }
}
