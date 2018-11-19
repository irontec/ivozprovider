<?php

namespace Ivoz\Provider\Domain\Service\InvoiceNumberSequence;

use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Service\Invoice\InvoiceLifecycleEventHandlerInterface;

class CheckValidity implements InvoiceNumberSequenceLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = InvoiceLifecycleEventHandlerInterface::PRIORITY_HIGH;

    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @throws \DomainException
     */
    public function execute(InvoiceNumberSequenceInterface $entity)
    {
        $isNew = $entity->isNew();
        if ($isNew) {
            return;
        }

        if ($entity->hasChanged('prefix')) {
            throw new \DomainException('Prefix modification is not allowed');
        }

        if ($entity->hasChanged('sequenceLength')) {
            throw new \DomainException('SequenceLength modification is not allowed');
        }

        if ($entity->hasChanged('increment')) {
            throw new \DomainException('Increment modification is not allowed');
        }
    }
}
