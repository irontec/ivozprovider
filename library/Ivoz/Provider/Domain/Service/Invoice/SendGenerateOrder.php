<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Invoicer;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

class SendGenerateOrder implements InvoiceLifecycleEventHandlerInterface
{
    protected $invoicer;

    public function __construct(
        Invoicer $invoicer
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

        $this->invoicer
            ->setId($invoice->getId())
            ->send();
    }
}
