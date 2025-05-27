<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements FixedCostsRelInvoiceLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param FixedCostsRelInvoiceInterface $relInvoice
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(FixedCostsRelInvoiceInterface $relInvoice)
    {
        $this->assertUnchanged(
            $relInvoice,
            [
                'quantity'
            ]
        );
    }
}
