<?php

namespace Dialplan;

use Agi\Action\HuntGroupStatusAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use RouteHandlerAbstract;

class HuntGroupStatus extends RouteHandlerAbstract
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
     * @var HuntGroupStatusAction
     */
    protected $huntGroupStatusAction;

    /**
     * HuntGroups constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param HuntGroupStatusAction $huntGroupStatusAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        HuntGroupStatusAction $huntGroupStatusAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->huntGroupStatusAction = $huntGroupStatusAction;
    }

    /**
     * @brief Process Huntgroup after call status
     */
    public function process()
    {
        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupRepository $huntgroupRepository */
        $huntgroupRepository = $this->em->getRepository(HuntGroup::class);

        // Get conference Id from extension
        $huntgroupId = $this->agi->getVariable("HG_ID");

        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntgroup */
        $huntgroup = $huntgroupRepository->find($huntgroupId);

        // Handle last called user status
        $this->huntGroupStatusAction
            ->setHuntGroup($huntgroup)
            ->process();
    }
}
