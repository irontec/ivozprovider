<?php

namespace Ivoz\Ast\Domain\Job;

interface AriDialplanReloadJobInterface
{
    public const CHANNEL = 'AsteriskDialplanReload';

    public const METHODS = [
        self::CHANNEL,
    ];

    public function send(): void;
}
