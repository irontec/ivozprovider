<?php

namespace Service\Domain;

use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\LastMonthCalls;

class GetLastMonthCalls
{
    public function __construct(
        private UsersCdrRepository $usersCdrRepository
    ) {
    }

    public function execute(UserInterface $user): LastMonthCalls
    {
        $inbound = $this->usersCdrRepository
            ->countInboundCallsInLastMonthByUser(
                (int) $user->getId()
            );
        $outbound = $this->usersCdrRepository
            ->countOutboundCallsInLastMonthByUser(
                (int) $user->getId()
            );

        return new LastMonthCalls($inbound, $outbound);
    }
}
