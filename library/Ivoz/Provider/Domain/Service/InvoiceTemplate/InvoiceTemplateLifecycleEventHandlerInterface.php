<?php

namespace Ivoz\Provider\Domain\Service\InvoiceTemplate;

use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;

interface InvoiceTemplateLifecycleEventHandlerInterface
{
    public function execute(InvoiceTemplateInterface $entity);
}