<?php

namespace Ivoz\Cgr\Infrastructure\Redis\Job;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Psr\Log\LoggerInterface;

class Cgrates implements RaterReloadInterface
{
    private $redisMasterFactory;
    private $redisDb;
    private $logger;

    private $tpid;
    private $notifyThresholdForAccount;
    private $disableDestinations = false;

    public function __construct(
        RedisMasterFactory $redisMasterFactory,
        int $redisDb,
        LoggerInterface $logger
    ) {
        $this->redisMasterFactory = $redisMasterFactory;
        $this->redisDb = $redisDb;
        $this->logger = $logger;
    }

    public function setTpid($tpid): self
    {
        $this->tpid = $tpid;
        return $this;
    }

    public function getTpid(): string
    {
        return $this->tpid;
    }

    public function getNotifyThresholdForAccount(): ?string
    {
        return $this->notifyThresholdForAccount;
    }

    public function setNotifyThresholdForAccount(?string $notifyThresholdForAccount): self
    {
        $this->notifyThresholdForAccount = $notifyThresholdForAccount;

        return $this;
    }

    public function getDisableDestinations(): bool
    {
        return $this->disableDestinations;
    }

    public function setDisableDestinations(bool $disableDestinations): self
    {
        $this->disableDestinations = $disableDestinations;

        return $this;
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $data = [
                'tpid' => $this->tpid,
                'notifyThresholdForAccount' => $this->notifyThresholdForAccount,
                'disableDestinations' => $this->disableDestinations,
            ];

            $redisClient->rPush(
                self::CHANNEL,
                \json_encode($data)
            );

            $redisClient->close();
        } catch (\Exception $e) {
            $this
                ->logger
                ->error(
                    $e->getMessage()
                );
        }
    }
}
