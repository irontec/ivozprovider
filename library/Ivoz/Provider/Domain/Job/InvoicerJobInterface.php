<?php

namespace Ivoz\Provider\Domain\Job;

interface InvoicerJobInterface
{
    const CHANNEL = 'InvoicesCreate';

    public function setId(int $id);

    public function send(): void;
}
