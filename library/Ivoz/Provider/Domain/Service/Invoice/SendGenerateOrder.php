<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Invoicer;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
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

    public function execute(InvoiceInterface $invoice)
    {
        $pendingStatus = $invoice->getStatus() === InvoiceInterface::STATUS_WAITING;
        $statusHasChanged = $invoice->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->invoicer
                ->setId($invoice->getId())
                ->send();
        }
    }
}
