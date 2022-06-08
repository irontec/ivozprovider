<?php

namespace Dialplan;

use Agi\Action\ExternalNumberAction;
use Agi\Action\UserCallAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberRepository;
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
        /** @var HuntGroupMemberRepository $huntGroupMemberRepository */
        $huntGroupMemberRepository = $this->em->getRepository(HuntGroupMemberInterface::class);

        // Get conference Id from extension
        $huntGroupMemberId = $this->agi->getExtension();

        /** @var HuntGroupMemberInterface $huntGroupMember */
        $huntGroupMember = $huntGroupMemberRepository->find($huntGroupMemberId);

        // Get Hunt group configuration
        $huntGroup = $huntGroupMember->getHuntGroup();

        // Route to next Action
        if ($huntGroupMember->getRouteType() == HuntGroupMemberInterface::ROUTETYPE_USER) {
            $this->userCallAction
                ->setUser($huntGroupMember->getUser())
                ->setAllowCallForwards($huntGroup->getAllowCallForwards())
                ->process();
        } else {
            if ($huntGroup->getStrategy() === HuntGroupInterface::STRATEGY_RINGALL) {
                $this->agi->ringing();
            }
            $this->externalNumberCallAction
                ->setDestination($huntGroupMember->getNumberValueE164())
                ->process();
        }
    }
}
