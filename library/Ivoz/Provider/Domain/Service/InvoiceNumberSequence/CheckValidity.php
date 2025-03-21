<?php

namespace Ivoz\Provider\Domain\Service\InvoiceNumberSequence;

use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Service\Invoice\InvoiceLifecycleEventHandlerInterface;

class CheckValidity implements InvoiceNumberSequenceLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = InvoiceLifecycleEventHandlerInterface::PRIORITY_HIGH;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(InvoiceNumberSequenceInterface $sequence)
    {
        $isNew = $sequence->isNew();
        if ($isNew) {
            return;
        }

        if ($sequence->hasChanged('prefix')) {
            throw new \DomainException('Prefix modification is not allowed');
        }

        if ($sequence->hasChanged('sequenceLength')) {
            throw new \DomainException('SequenceLength modification is not allowed');
        }

        if ($sequence->hasChanged('increment')) {
            throw new \DomainException('Increment modification is not allowed');
        }
    }
}
