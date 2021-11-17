<?php

namespace Ivoz\Cgr\Infrastructure\Redis\Job;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Psr\Log\LoggerInterface;

class Cgrates implements RaterReloadInterface
{
    /** @var ?string */
    private $tpid;
    /** @var ?string */
    private $notifyThresholdForAccount;
    /** @var bool */
    private $disableDestinations = false;

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger
    ) {
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
                \json_encode($data, JSON_THROW_ON_ERROR)
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
