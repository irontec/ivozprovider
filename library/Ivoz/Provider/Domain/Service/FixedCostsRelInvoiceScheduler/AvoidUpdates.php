<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements FixedCostsRelInvoiceSchedulerLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param FixedCostsRelInvoiceSchedulerInterface $relInvoiceScheduler
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(FixedCostsRelInvoiceSchedulerInterface $relInvoiceScheduler)
    {
        $this->assertUnchanged(
            $relInvoiceScheduler,
            [
                'quantity'
            ]
        );
    }
}
