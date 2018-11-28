<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerRepository;

class CheckUniqueness implements CallCsvSchedulerLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var CallCsvSchedulerRepository
     */
    protected $callCsvSchedulerRepository;

    public function __construct(CallCsvSchedulerRepository $callCsvSchedulerRepository)
    {
        $this->callCsvSchedulerRepository = $callCsvSchedulerRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @throws \Exception
     */
    public function execute(CallCsvSchedulerInterface $callCsvScheduler)
    {
        if ($callCsvScheduler->getBrand()) {
            //Checked through mysql unique key
            return;
        }

        $unique = $this->callCsvSchedulerRepository->hasUniqueName($callCsvScheduler);

        if (!$unique) {
            throw new \DomainException('Name already in use');
        }
    }
}
