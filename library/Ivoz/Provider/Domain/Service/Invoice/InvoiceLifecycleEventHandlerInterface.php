<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

interface InvoiceLifecycleEventHandlerInterface
{
    public function execute(InvoiceInterface $entity);
}