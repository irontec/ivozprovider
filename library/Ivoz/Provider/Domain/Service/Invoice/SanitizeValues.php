<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Invoice
 * @lifecycle pre_persist
 */
class SanitizeValues implements InvoiceLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(InvoiceInterface $entity)
    {
        if (is_null($entity->getStatus())) {
            $entity->setStatus("waiting");
        }
    }
}