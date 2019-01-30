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
        // Queue member id from dialed extension
        $queueMemberId = $this->agi->getExtension();

        /** @var QueueMemberRepository $queueMemberRepository */
        $queueMemberRepository = $this->em->getRepository(QueueMember::class);

        /** @var QueueMemberInterface $queueMember */
        $queueMember = $queueMemberRepository->find($queueMemberId);
        if (is_null($queueMember)) {
            $this->agi->error("Queue member with id %d does not exists.", $queueMemberId);
            return;
        }

        // Prepate to call the queue member
        $this->queueCallAction
            ->setQueueMember($queueMember)
            ->process();
    }
}
