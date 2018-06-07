<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

interface InvoiceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(InvoiceInterface $entity);
}