<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr\Event;

use Ivoz\Core\Domain\Event\DomainEventTrait;
use Ivoz\Core\Domain\Event\StoppableDomainEventInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Symfony\Contracts\EventDispatcher\Event;

class TrunksCdrWasMigrated extends Event implements StoppableDomainEventInterface
{
    use DomainEventTrait;

    /**
     * @var TrunksCdrInterface
     */
    private $trunksCdr;

    /**
     * @var BillableCallInterface
     */
    private $billableCall;

    public function __construct(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall
    ) {
        $this->setEventTimestamp();

        $this->trunksCdr = $trunksCdr;
        $this->billableCall = $billableCall;
    }

    public function getTrunksCdr(): TrunksCdrInterface
    {
        return $this->trunksCdr;
    }

    public function getBillableCall(): BillableCallInterface
    {
        return $this->billableCall;
    }
}
