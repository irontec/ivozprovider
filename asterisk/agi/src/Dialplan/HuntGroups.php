<?php

namespace Dialplan;

use Agi\Action\HuntGroupCallAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupRepository;
use RouteHandlerAbstract;

class HuntGroups extends RouteHandlerAbstract
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
     * @var HuntGroupCallAction
     */
    protected $huntGroupCallAction;

    /**
     * HuntGroups constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param HuntGroupCallAction $huntGroupCallAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        HuntGroupCallAction $huntGroupCallAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->huntGroupCallAction = $huntGroupCallAction;
    }

    public function process()
    {
        /** @var HuntGroupRepository $huntgroupRepository */
        $huntgroupRepository = $this->em->getRepository(HuntGroup::class);

        // Get conference Id from extension
        $huntgroupId = $this->agi->getVariable("HG_ID");

        /** @var HuntGroupInterface $huntgroup */
        $huntgroup = $huntgroupRepository->find($huntgroupId);

        // Configure next call
        $this->huntGroupCallAction
            ->setHuntGroup($huntgroup)
            ->process();
    }
}
