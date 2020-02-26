<?php

namespace Dialplan;

use Agi\Action\HuntGroupCallAction;
use Agi\Action\RouterAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
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
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * HuntGroups constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->routerAction = $routerAction;
    }

    public function process()
    {
        /** @var HuntGroupsRelUserRepository $huntgroupsRelUserRepository */
        $huntgroupsRelUserRepository = $this->em->getRepository(HuntGroupsRelUser::class);

        // Get conference Id from extension
        $huntgroupsRelUserId = $this->agi->getExtension();

        /** @var HuntGroupsRelUserInterface $huntgroupsRelUser */
        $huntgroupsRelUser = $huntgroupsRelUserRepository->find($huntgroupsRelUserId);

        // Route to the extension destination
        $this->routerAction
            ->setRouteType($huntgroupsRelUser->getRouteType())
            ->setRouteUser($huntgroupsRelUser->getUser())
            ->setRouteExternal($huntgroupsRelUser->getNumberValueE164())
            ->route();
    }
}
