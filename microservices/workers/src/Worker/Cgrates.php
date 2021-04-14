<?php

namespace Worker;

use GearmanJob;
use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ReloadService;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Psr\Log\LoggerInterface;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

/**
 * @Gearman\Work(
 *     name = "Cgrates",
 *     description = "Handle Cgrates related async tasks",*
 *     service = "Worker\Cgrates",
 *     iterations = 1
 * )
 */
class Cgrates
{
    use RegisterCommandTrait;

    private $eventPublisher;
    private $requestId;
    private $reloadService;
    private $logger;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        ReloadService $reloadService,
        LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->reloadService = $reloadService;
        $this->logger = $logger;
    }

    /**
     * Send CGRateS reload request
     *
     * @Gearman\Job(
     *     name = "reload",
     *     description = "Reload a given tpid in CGRateS"
     * )
     *
     * @param GearmanJob $serializedJob Serialized object with job parameters
     * @return boolean
     *
     * @throws \Exception
     */
    public function reload(GearmanJob $serializedJob)
    {
        try {
            // Thanks Gearmand, you've done your job
            $serializedJob->sendComplete("DONE");
            $this->registerCommand('Worker', 'cgrates');

            /** @var RaterReloadInterface $job */
            $job = igbinary_unserialize($serializedJob->workload());

            $this->logger->info(
                'ApierV1.LoadTariffPlanFromStorDb GEARMAN payload ' . var_export($job, true)
            );

            $cgratesTpid = $job->getTpid();

            $this->logger->info(sprintf("ApierV1.LoadTariffPlanFromStorDb GEARMAN Reloading Tpid %s through CGRateS API", $cgratesTpid));

            $this
                ->reloadService
                ->execute(
                    $cgratesTpid,
                    $job->getDisableDestinations()
                );

            $this->logger->info(sprintf("ApierV1.LoadTariffPlanFromStorDb GEARMAN Reloaded Tpid %s through CGRateS API", $cgratesTpid));
            // Done!
            return true;
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }
    }
}
