<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;

interface FixedCostsRelInvoiceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(FixedCostsRelInvoiceInterface $relInvoice);
}
