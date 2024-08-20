<?php

namespace Ivoz\Provider\Domain\Service;

interface HostnameGetter
{
    public function __invoke(): ?string;
}
