<?php

namespace Ivoz\Provider\Domain\Job;

interface RatesImporterJobInterface
{
    public function setParams(array $params);

    public function getParams(): array;

    public function send(): void;
}
