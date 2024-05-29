<?php

namespace Ivoz\Provider\Application\Service\Friend;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;

class CreateInterVpbxFriend
{
    public function __construct(
        private EntityTools $entityTools,
        private FriendRepository $friendRepository
    ) {
    }

    public function execute(FriendInterface $friend): void
    {
        if ($friend->getDirectConnectivity() !== Friend::DIRECTCONNECTIVITY_INTERVPBX) {
            throw new \RuntimeException('Direct connectivity must be interVpbx');
        }

        if (!$friend->isNew()) {
            throw new \RuntimeException('Friend must be new');
        }

        $companyId = $friend->getCompany()->getId() ?? 0;
        $maxCompanyPriority = $this
            ->friendRepository
            ->getMaxPriorityForCompany($companyId);

        $friendDto = Friend::createDto();
        $friendDto
            ->setCompanyId(
                $friend->getInterCompany()?->getId()
            )
            ->setInterCompanyId(
                $friend->getCompany()->getId()
            )
            ->setTransport(
                $friend->getTransport()
            )
            ->setDirectConnectivity(Friend::DIRECTCONNECTIVITY_INTERVPBX)
            ->setPriority($maxCompanyPriority + 1)
            ->setName('noNameRequired');


        $this->entityTools->persistDto($friendDto);
    }
}
