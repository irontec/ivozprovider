<?php

namespace Ivoz\Kam\Domain\Job;

interface RpcJobInterface
{
    public const CHANNEL = 'RpcCall';

    public const CHANNEL_RETRY_ON_ERROR = 'RpcCallRetryOnError';

    public const METHODS = [
        self::CHANNEL,
        self::CHANNEL_RETRY_ON_ERROR,
    ];

    public function send(string $method, bool $retryOnError = false): void;
}
