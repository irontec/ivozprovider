<?php

namespace Worker;

use GearmanJob;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ReloadService;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Cgrates as CgratesJob;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Psr\Log\LoggerInterface;

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

    /**
     * @var ReloadService
     */
    protected $reloadService;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Multimedia constructor.
     * @param ReloadService $reloadService
     * @param LoggerInterface $logger
     */
    public function __construct(
        ReloadService $reloadService,
        LoggerInterface $logger
    ) {
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
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        /** @var CgratesJob $job */
        $job = igbinary_unserialize($serializedJob->workload());

        $cgratesTpid = $job->getTpid();

        $this->logger->info(sprintf("Reloading Tpid %s through CGRateS API", $cgratesTpid));

        $this->reloadService
            ->execute($cgratesTpid);

        // Done!
        return true;
    }
}
