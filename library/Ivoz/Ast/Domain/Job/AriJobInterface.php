<?php

namespace Ivoz\Ast\Domain\Job;

interface AriJobInterface
{
    public const CHANNEL = 'Asterisk';

    public const METHODS = [
        self::CHANNEL,
    ];

    public function send(): void;
}
