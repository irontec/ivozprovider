<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UpdateFromUser
{
    public function __construct(
        private QueueMemberRepository $ivozQueueMemberRepository,
        private UpdateFromQueueMember $updateFromQueueMember,
    ) {
    }

    public function execute(UserInterface $user): void
    {
        $queueMembers = $this->ivozQueueMemberRepository->findByUserId(
            (int) $user->getId()
        );

        foreach ($queueMembers as $queueMember) {
            $this->updateFromQueueMember->execute($queueMember);
        }
    }
}
