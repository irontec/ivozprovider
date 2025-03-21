<?php

namespace Ivoz\Provider\Domain\Service\InvoiceNumberSequence;

use Ivoz\Core\Domain\Service\EntityTools;
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
     * @return null|string
     */
    public function execute(InvoiceNumberSequenceInterface $sequence): ?string
    {
        $this->entityTools->lock(
            $sequence,
            $sequence->getVersion()
        );

        $nextVal = $sequence->nextval();
        $this->entityTools->persist(
            $sequence
        );

        return $nextVal;
    }
}
