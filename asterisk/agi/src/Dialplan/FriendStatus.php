<?php

namespace Dialplan;

use Agi\Action\FriendStatusAction;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use RouteHandlerAbstract;

class FriendStatus extends RouteHandlerAbstract
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
     * @var FriendStatusAction
     */
    protected $friendStatusAction;

    /**
     * FriendStatus constructor.
     *
     * @param Wrapper $agi
     * @param EndpointResolver $endpointResolver
     * @param FriendStatusAction $friendStatusAction
     */
    public function __construct(
        Wrapper $agi,
        EndpointResolver $endpointResolver,
        FriendStatusAction $friendStatusAction
    ) {
        $this->agi = $agi;
        $this->endpointResolver = $endpointResolver;
        $this->friendStatusAction = $friendStatusAction;
    }

    /**
     * Check status after calling a friend endpoint
     *
     * @throws \InvalidArgumentException
     */
    public function process()
    {
        // Get the called endpoint to check postcall actions
        $endpointName = $this->agi->getVariable("DIAL_ENDPOINT");

        // Get friend from the endpoint.
        $friend = $this->endpointResolver->getFriendFromEndpoint($endpointName);

        // ProcessDialStatus
        $this->friendStatusAction
            ->setFriend($friend)
            ->process();
    }
}
