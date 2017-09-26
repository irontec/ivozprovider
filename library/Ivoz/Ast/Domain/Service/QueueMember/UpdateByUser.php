<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    /**
     * @var UpdateByIvozQueueMember
     */
    protected $updateByIvozQueueMember;

    public function __construct(
        UpdateByIvozQueueMember $updateByIvozQueueMember
    ) {
        $this->updateByIvozQueueMember = $updateByIvozQueueMember;
    }

    public function execute(UserInterface $entity, $isNew)
    {
        $hasChangedTerminal = $entity->hasChanged('terminalId');
        $hasChangedExtension = $entity->hasChanged("extensionId");

        // Update all queue member entries for this user
        if ($hasChangedExtension || $hasChangedTerminal) {
            foreach ($entity->getQueueMembers() as $member) {
                $this->updateByIvozQueueMember->execute($member);
            }
        }
    }
}