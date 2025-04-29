<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Service\Recording\RecordingLifecycleEventHandlerInterface;

class UpdateByRecording implements RecordingLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;
    public const POST_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
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
        $billableCall = $recording->getBillableCall();

        if (is_null($billableCall)) {
            return;
        }

        $isRemoved = $recording->hasChanged('id') && !$recording->getId();
        $isNew = $recording->isNew();

        if (!($isRemoved || $isNew)) {
            return;
        }

        $currentRecordingsCount = $billableCall->getNumRecordings();

        $recordingsCount = $isNew
            ? $currentRecordingsCount + 1
            : $currentRecordingsCount - 1;

        $this->updateRecordingsCount($billableCall, $recordingsCount);
    }

    private function updateRecordingsCount(BillableCallInterface $billableCall, int $recordingsCount): void
    {
        /** @var BillableCallDto $billableCallDto */
        $billableCallDto = $this->entityTools->entityToDto($billableCall);
        $billableCallDto->setNumRecordings(
            $recordingsCount
        );

        $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            true
        );
    }
}
