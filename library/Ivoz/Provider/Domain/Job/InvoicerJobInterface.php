<?php

namespace Ivoz\Provider\Domain\Job;

interface InvoicerJobInterface
{
    const CHANNEL = 'WorkerInvoices~create';

    public function setId(int|string $id);

    public function send(): void;
}
