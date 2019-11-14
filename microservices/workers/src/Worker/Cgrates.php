<?php

namespace Worker;

use GearmanJob;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ReloadService;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Cgrates as CgratesJob;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Psr\Log\LoggerInterface;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\SetMaxUsageThresholdService;

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
    private $setMaxUsageThresholdService;
    private $companyRepository;
    private $logger;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        ReloadService $reloadService,
        SetMaxUsageThresholdService $setMaxUsageThresholdService,
        CompanyRepository $companyRepository,
        LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->reloadService = $reloadService;
        $this->setMaxUsageThresholdService = $setMaxUsageThresholdService;
        $this->companyRepository = $companyRepository;
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
        $this->registerCommand('Worker', 'cgrates');

        /** @var CgratesJob $job */
        $job = igbinary_unserialize($serializedJob->workload());

        $this->logger->info(
            'ApierV1.LoadTariffPlanFromStorDb GEARMAN payload ' . var_export($job, true)
        );

        $cgratesTpid = $job->getTpid();
        $notifyThresholdForAccount = $job->getNotifyThresholdForAccount();

        $this->logger->info(sprintf("ApierV1.LoadTariffPlanFromStorDb GEARMAN Reloading Tpid %s through CGRateS API", $cgratesTpid));

        $this
            ->reloadService
            ->execute(
                $cgratesTpid,
                $job->getDisableDestinations()
            );

        if ($notifyThresholdForAccount) {

            /** @var CompanyInterface $company */
            $company = $this->companyRepository->find(
                substr($notifyThresholdForAccount, 1)
            );

            if (!$company) {
                $this->logger->error(
                    'Not company found for account ' . $notifyThresholdForAccount
                );

                return false;
            }

            $this
                ->setMaxUsageThresholdService
                ->execute(
                    $cgratesTpid,
                    $notifyThresholdForAccount,
                    $company->getMaxDailyUsage()
                );
        }

        $this->logger->info(sprintf("ApierV1.LoadTariffPlanFromStorDb GEARMAN Reloaded Tpid %s through CGRateS API", $cgratesTpid));
        // Done!
        return true;
    }
}
