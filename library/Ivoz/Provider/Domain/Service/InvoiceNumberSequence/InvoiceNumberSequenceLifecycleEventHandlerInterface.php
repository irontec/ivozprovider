<?php

namespace Ivoz\Provider\Domain\Service\InvoiceNumberSequence;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;

interface InvoiceNumberSequenceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(InvoiceNumberSequenceInterface $entity);
}
