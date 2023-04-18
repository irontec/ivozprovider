<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Ast\Domain\Model\QueueMember\QueueMember;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberDto;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberRepository;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface as IvozQueueMemberInterface;

class UpdateFromQueueMember
{
    public function __construct(
        private EntityTools $entityTools,
        private QueueMemberRepository $queueMemberRepository
    ) {
    }

    public function execute(IvozQueueMemberInterface $ivozQueueMember): void
    {
        $queue = $ivozQueueMember->getQueue();
        $user = $ivozQueueMember->getUser();
        $terminal = $user->getTerminal();
        $extension = $user->getExtension();

        /** @var QueueMember|null $astQueueMember */
        $astQueueMember = $this->queueMemberRepository->findOneByProviderQueueMemberId(
            (int) $ivozQueueMember->getId()
        );

        // Avoid creating members without terminal or extension
        if (!$terminal || !$extension) {
            if ($astQueueMember) {
                $this->entityTools->remove($astQueueMember);
            }
            return;
        }

        /** @var QueueMemberDto $astQueueMemberDto */
        $astQueueMemberDto = is_null($astQueueMember)
            ? QueueMember::createDto()
            : $this->entityTools->entityToDto($astQueueMember);

        // Create new queue member
        $uniqueid = $ivozQueueMember->getAstQueueMemberName();
        $queueName = $queue->getAstQueueName();
        $interface = sprintf("Local/%s@queues", $extension->getNumber());
        $memberName = $user->getFullName();
        $stateInterface = sprintf("PJSIP/%s", $terminal->getSorcery());
        $penalty = (int)$ivozQueueMember->getPenalty();
        $queueMemberId = $ivozQueueMember->getId();

        $astQueueMemberDto
            ->setUniqueid($uniqueid)
            ->setQueueName($queueName)
            ->setInterface($interface)
            ->setMembername($memberName)
            ->setStateInterface($stateInterface)
            ->setPenalty($penalty)
            ->setQueueMemberId($queueMemberId);

        $this->entityTools->persistDto(
            $astQueueMemberDto,
            $astQueueMember
        );
    }
}
