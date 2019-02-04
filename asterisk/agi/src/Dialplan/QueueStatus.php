<?php

namespace Dialplan;

use Agi\Action\QueueFullAction;
use Agi\Action\QueueTimeoutAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use RouteHandlerAbstract;

class QueueStatus extends RouteHandlerAbstract
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
     * @var QueueTimeoutAction
     */
    protected $queueTimeoutAction;

    /**
     * @var QueueFullAction
     */
    protected $queueFullAction;

    /**
     * QueueStatus constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param QueueTimeoutAction $queueTimeoutAction
     * @param QueueFullAction $queueFullAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        QueueTimeoutAction $queueTimeoutAction,
        QueueFullAction $queueFullAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->queueTimeoutAction = $queueTimeoutAction;
        $this->queueFullAction = $queueFullAction;
    }

    /**
     * @brief After Queue process
     */
    public function process()
    {
        $queueId = $this->agi->getVariable("QUEUE_ID");

        /** @var \Ivoz\Provider\Domain\Model\Queue\QueueRepository $queueRepository */
        $queueRepository = $this->em->getRepository(Queue::class);

        /** @var \Ivoz\Ast\Domain\Model\Queue\QueueInterface $queue */
        $queue = $queueRepository->find($queueId);

        // Get queue call end status
        $queueStatus = $this->agi->getVariable("QUEUESTATUS");


        if ($queueStatus == 'TIMEOUT') {
            $this->queueTimeoutAction
                ->setQueue($queue)
                ->process();
        } elseif ($queueStatus == 'FULL') {
            $this->queueFullAction
                ->setQueue($queue)
                ->process();
        }
    }
}
