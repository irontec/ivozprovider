<?php

namespace Ivoz\Provider\Domain\Job;

interface RatesImporterJobInterface
{
    const CHANNEL = 'RatesImport';

    public function setParams(array $params): self;

    public function getParams(): array;

    public function send(): void;
}
