<?php

namespace Ivoz\Provider\Domain\Service\UsersCdr;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Service\Recording\RecordingLifecycleEventHandlerInterface;

class UpdateByRecording implements RecordingLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;
    public const POST_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private UsersCdrRepository $usersCdrRepository,
    ) {
    }

    /**
     * @return array<string,int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY,
        ];
    }

    public function execute(RecordingInterface $recording): void
    {
        $usersCdr = $recording->getUsersCdr();

        if (is_null($usersCdr)) {
            return;
        }

        $isRemoved = $recording->hasChanged('id') && !$recording->getId();
        $isNew = $recording->isNew();

        if (!($isRemoved || $isNew)) {
            return;
        }

        $currentRecordingsCount = $usersCdr->getNumRecordings();

        $recordingsCount = $isNew
            ? $currentRecordingsCount + 1
            : $currentRecordingsCount - 1;

        $this->updateRecordingsCount($usersCdr, $recordingsCount);
    }

    private function updateRecordingsCount(UsersCdrInterface $usersCdr, int $recordingsCount): void
    {
        /** @var UsersCdrDto $userCdrDto */
        $userCdrDto = $this->entityTools->entityToDto($usersCdr);
        $userCdrDto->setNumRecordings(
            $recordingsCount
        );

        $this
            ->usersCdrRepository
            ->persistDto(
                $userCdrDto,
                $usersCdr,
                true
            );
    }
}
