<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Service\QueueMember\QueueMemberLifecycleEventHandlerInterface
    as IvozQueueMemberLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface as IvozQueueMemberInterface;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberInterface as AstQueueMemberInterface;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMember as AstQueueMember;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberRepository as AstQueueMemberRepository;

class UpdateByIvozQueueMember implements IvozQueueMemberLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var AstQueueMemberRepository
     */
    protected $astQueueMemberRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        AstQueueMemberRepository $astQueueMemberRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->astQueueMemberRepository = $astQueueMemberRepository;
    }

    public function execute(IvozQueueMemberInterface $entity, $isNew)
    {
        $user = $entity->getUser();
        $userEndpointName = $user
            ->getEndpoint()
            ->getSorceryId();

        $queue = $entity->getQueue();
        $company = $queue->getCompany();

        $queueMemberCode = sprintf("b%dc%dq%dm%d",
            $company->getBrand()->getId(),
            $company->getId(),
            $queue->getId(),
            $entity->getId()
        );

        /**
         * @var AstQueueMemberInterface $astQueueMember
         */
        $astQueueMember = $this->astQueueMemberRepository->findOneBy([
            'queueMember' => $entity->getId()
        ]);

        $astQueueMemberDTO = is_null($astQueueMember)
            ? AstQueueMember::createDTO()
            : $astQueueMember->toDTO();

        $astQueueMemberDTO
            ->setQueueMemberId($entity->getId())
            ->setId($entity->getId())
            ->setQueueName($entity->getQueue()->getAstQueueName())
            ->setInterface(sprintf("Local/%d@queues", $entity->getId()))
            ->setStateInterface(sprintf("PJSIP/%s", $userEndpointName))
            ->setPenalty($entity->getPenalty())
            ->setMembername($queueMemberCode);

        $this->entityPersister->persistDto($astQueueMemberDTO, $astQueueMember);
    }
}