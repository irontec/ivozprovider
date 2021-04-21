<?php

namespace Ivoz\Kam\Domain\Job;

interface RpcJobInterface
{
    const CHANNEL = 'RpcCall';

    const CHANNEL_RETRY_ON_ERROR = 'RpcCallRetryOnError';

    const METHODS = [
        self::CHANNEL,
        self::CHANNEL_RETRY_ON_ERROR,
    ];

    public function send(string $method, bool $retryOnError = false): void;
}
