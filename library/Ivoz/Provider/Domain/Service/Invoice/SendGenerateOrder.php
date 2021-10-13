<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Job\InvoicerJobInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

class SendGenerateOrder implements InvoiceLifecycleEventHandlerInterface
{
    private $invoicer;

    public function __construct(
        InvoicerJobInterface $invoicer
    ) {
        $this->invoicer = $invoicer;
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
            ->setId($invoice->getId())
            ->send();
    }
}
