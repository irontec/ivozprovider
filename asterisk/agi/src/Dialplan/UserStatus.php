<?php

namespace Dialplan;

use Agi\Wrapper;
use Agi\Action\UserStatusAction;
use Helpers\EndpointResolver;
use RouteHandlerAbstract;

class UserStatus extends RouteHandlerAbstract
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EndpointResolver
     */
    protected $endpointResolver;

    /**
     * @var UserStatusAction
     */
    protected $userStatusAction;

    /**
     * Users constructor.
     *
     * @param Wrapper $agi
     * @param EndpointResolver $endpointResolver
     * @param UserStatusAction $userStatusAction
     */
    public function __construct(
        Wrapper $agi,
        EndpointResolver $endpointResolver,
        UserStatusAction $userStatusAction
    ) {
        $this->agi = $agi;
        $this->endpointResolver = $endpointResolver;
        $this->userStatusAction = $userStatusAction;
    }


    /**
     * Outgoing calls from terminals to Extensions, Services or World
     *
     * @throws \Assert\AssertionFailedException
     */
    public function process()
    {
        // Get the called endpoint to check postcall actions
        $endpointName = $this->agi->getVariable("DIAL_ENDPOINT");

        // Get user from the endpoint.
        $user = $this->endpointResolver->getUserFromEndpoint($endpointName);

        // ProcessDialStatus
        $this->userStatusAction
            ->setUser($user)
            ->process();
    }
}
