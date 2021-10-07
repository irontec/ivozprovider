<?php

namespace Ivoz\Provider\Domain\Service\InvoiceNumberSequence;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;

/**
 * Class NextValGenerator
 */
class NextValGenerator
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @throws \DomainException
     *
     * @return string
     */
    public function execute(InvoiceNumberSequenceInterface $invoiceNumberGenerator): string
    {
        $this->entityTools->lock(
            $invoiceNumberGenerator,
            $invoiceNumberGenerator->getVersion()
        );

        $nextVal = $invoiceNumberGenerator->nextval();
        $this->entityTools->persist(
            $invoiceNumberGenerator
        );

        return $nextVal;
    }
}
