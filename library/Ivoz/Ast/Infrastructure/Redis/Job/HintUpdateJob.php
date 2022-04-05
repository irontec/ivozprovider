<?php

namespace Ivoz\Ast\Infrastructure\Redis\Job;

use Ivoz\Ast\Domain\Job\AriHintUpdateJobInterface;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Psr\Log\LoggerInterface;

class HintUpdateJob implements AriHintUpdateJobInterface
{
    /** @var ?string */
    private $deviceName;
    /** @var ?string */
    private $deviceState;

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger
    ) {
    }

    public function setDeviceName(string $deviceName): self
    {
        $this->deviceName = $deviceName;
        return $this;
    }

    public function getDeviceName(): ?string
    {
        return $this->deviceState;
    }

    public function setDeviceState(string $deviceState): self
    {
        $this->deviceState = $deviceState;
        return $this;
    }

    public function getDeviceState(): ?string
    {
        return $this->deviceState;
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $data = [
                'deviceName' => $this->deviceName,
                'deviceState' => $this->deviceState,
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
