<?php

namespace Ivoz\Provider\Domain\Job;

interface InvoicerJobInterface
{
    public const CHANNEL = 'InvoicesCreate';

    public function setId(int $id);

    public function send(): void;
}
