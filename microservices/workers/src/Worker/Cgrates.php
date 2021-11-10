<?php

namespace Worker;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ReloadService;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Psr\Log\LoggerInterface;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;
use Symfony\Component\HttpFoundation\Response;

class Cgrates
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private ReloadService $reloadService,
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function reload(): Response
    {
        try {
            $this->registerCommand('Worker', 'cgrates');

            $job = $this->getJobPayload();

            $this->logger->info(
                'ApierV1.LoadTariffPlanFromStorDb job payload ' . var_export($job, true)
            );

            $cgratesTpid = $job['tpid'];
            $this->logger->info(
                sprintf(
                    "ApierV1.LoadTariffPlanFromStorDb job Reloading Tpid %s through CGRateS API",
                    $cgratesTpid
                )
            );

            $this
                ->reloadService
                ->execute(
                    $cgratesTpid,
                    $job['disableDestinations']
                );

            $this->logger->info(
                sprintf(
                    "ApierV1.LoadTariffPlanFromStorDb job Reloaded Tpid %s through CGRateS API",
                    $cgratesTpid
                )
            );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        } finally {
            return new Response('');
        }
    }


    private function getJobPayload(): array
    {
        $redisMaster = $this
            ->redisMasterFactory
            ->create(
                $this->redisDb
            );

        try {
            $timeoutSeconds = 60 * 60;
            $response = $redisMaster->blPop(
                [RaterReloadInterface::CHANNEL],
                $timeoutSeconds
            );

            $data = end($response);
            return \json_decode($data, true);
        } catch (\RedisException $e) {
            $this->logger->error('Invoicer timeout');
            exit(1);
        }
    }
}
