<?php

namespace Ivoz\Cgr\Domain\Job;

interface RaterReloadInterface
{
    public const CHANNEL = 'CgratesReload';

    public function setTpid(string $tpid): self;

    public function getTpid(): ?string;

    public function setNotifyThresholdForAccount(?string $notifyThresholdForAccount): self;

    public function getNotifyThresholdForAccount(): ?string;

    public function setDisableDestinations(bool $disableDestinations): self;

    public function getDisableDestinations(): bool;

    public function send(): void;
}
