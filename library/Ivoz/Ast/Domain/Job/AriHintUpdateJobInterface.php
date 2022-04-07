<?php

namespace Ivoz\Ast\Domain\Job;

interface AriHintUpdateJobInterface
{
    public const CHANNEL = 'AsteriskHintUpdate';

    public const METHODS = [
        self::CHANNEL,
    ];

    public function setDeviceName(string $deviceName): self;

    public function getDeviceName(): ?string;

    public function setDeviceState(string $deviceState): self;

    public function getDeviceState(): ?string;

    public function send(): void;
}
