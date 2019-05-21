<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Service\InvoiceNumberSequence\NextValGenerator;

/**
 * Class SetInvoiceNumber
 */
class SetInvoiceNumber implements InvoiceLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = InvoiceLifecycleEventHandlerInterface::PRIORITY_LOW;

    /**
     * @var NextValGenerator
     */
    protected $nextValGenerator;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        NextValGenerator $nextValGenerator,
        EntityTools $entityTools
    ) {
        $this->nextValGenerator = $nextValGenerator;
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(InvoiceInterface $invoice)
    {
        if (!$invoice->hasChanged('status')) {
            return;
        }

        $processing = $invoice->isProcessing();
        if (!$processing) {
            return;
        }

        if ($invoice->getNumber()) {
            return;
        }

        $invoiceNumberGenerator = $invoice->getNumberSequence();
        if (!$invoiceNumberGenerator) {
            return;
        }

        $invoiceNumber = $this->nextValGenerator->execute($invoiceNumberGenerator);

        $invoiceDto = $this->entityTools->entityToDto($invoice);
        $invoiceDto->setNumber($invoiceNumber);

        $this->entityTools->updateEntityByDto(
            $invoice,
            $invoiceDto
        );
    }
}
