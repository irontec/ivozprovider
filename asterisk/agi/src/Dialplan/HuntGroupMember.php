<?php

namespace Dialplan;

use Agi\Action\ExternalNumberAction;
use Agi\Action\UserCallAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserRepository;
use RouteHandlerAbstract;

class HuntGroupMember extends RouteHandlerAbstract
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
     * @var UserCallAction
     */
    protected $userCallAction;

    /**
     * @var ExternalNumberAction
     */
    protected $externalNumberCallAction;

    /**
     * HuntGroups constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param UserCallAction $userCallAction
     * @param ExternalNumberAction $externalNumberCallAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        UserCallAction $userCallAction,
        ExternalNumberAction $externalNumberCallAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->userCallAction = $userCallAction;
        $this->externalNumberCallAction = $externalNumberCallAction;
    }

    public function process()
    {
        /** @var HuntGroupsRelUserRepository $huntgroupsRelUserRepository */
        $huntgroupsRelUserRepository = $this->em->getRepository(HuntGroupsRelUser::class);

        // Get conference Id from extension
        $huntgroupsRelUserId = $this->agi->getExtension();

        /** @var HuntGroupsRelUserInterface $huntgroupsRelUser */
        $huntgroupsRelUser = $huntgroupsRelUserRepository->find($huntgroupsRelUserId);

        // Get Huntgroup configuration
        $huntgroup = $huntgroupsRelUser->getHuntGroup();

        // Route to next Action
        if ($huntgroupsRelUser->getRouteType() == HuntGroupsRelUserInterface::ROUTETYPE_USER) {
            $this->userCallAction
                ->setUser($huntgroupsRelUser->getUser())
                ->setAllowCallForwards($huntgroup->getAllowCallForwards())
                ->process();
        } else {
            if ($huntgroup->getStrategy() === HuntGroupInterface::STRATEGY_RINGALL) {
                $this->agi->ringing();
            }
            $this->externalNumberCallAction
                ->setDestination($huntgroupsRelUser->getNumberValueE164())
                ->process();
        }
    }
}
