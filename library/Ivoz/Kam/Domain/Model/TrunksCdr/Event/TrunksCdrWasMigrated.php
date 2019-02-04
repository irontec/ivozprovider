<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr\Event;

use Ivoz\Core\Domain\Event\StoppableDomainEventInterface;
use Ivoz\Core\Domain\Event\DomainEventTrait;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Events\AbstractBalanceThresholdWasBroken;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Symfony\Component\EventDispatcher\Event;

class TrunksCdrWasMigrated extends Event implements StoppableDomainEventInterface
{
    use DomainEventTrait;

    /**
     * @var TrunksCdrInterface
     */
    protected $trunksCdr;

    /**
     * @var BillableCallInterface
     */
    protected $billableCall;

    public function __construct(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall
    ) {
        $this->setEventTimestamp();

        $this->trunksCdr = $trunksCdr;
        $this->billableCall = $billableCall;
    }

    public function getTrunksCdr()
    {
        return $this->trunksCdr;
    }

    public function getBillableCall()
    {
        return $this->billableCall;
    }
}
