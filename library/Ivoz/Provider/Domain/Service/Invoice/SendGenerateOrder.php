<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Job\InvoicerJobInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

class SendGenerateOrder implements InvoiceLifecycleEventHandlerInterface
{
    public function __construct(
        private InvoicerJobInterface $invoicer
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(InvoiceInterface $invoice)
    {
        $mustRunInvoicer = $invoice->mustRunInvoicer();
        if (!$mustRunInvoicer) {
            return;
        }

        $this
            ->invoicer
            ->setId(
                (int) $invoice->getId()
            )
            ->send();
    }
}
