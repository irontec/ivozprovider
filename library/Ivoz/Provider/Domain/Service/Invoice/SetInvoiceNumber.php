<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\AccCdrRepository;
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

    public function __construct(
        NextValGenerator $nextValGenerator
    ) {
        $this->nextValGenerator = $nextValGenerator;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(InvoiceInterface $entity)
    {
        if (!$entity->hasChanged('status')) {
            return;
        }

        $processing = $entity->isProcessing();
        if (!$processing) {
            return;
        }

        if ($entity->getNumber()) {
            return;
        }

        $invoiceNumberGenerator = $entity->getNumberSequence();
        if (!$invoiceNumberGenerator) {
            return;
        }

        $invoiceNumber = $this->nextValGenerator->execute($invoiceNumberGenerator);
        $entity->setNumber($invoiceNumber);
    }
}