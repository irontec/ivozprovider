<?php

namespace spec\Ivoz\Provider\Domain\Service\LcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Service\LcrRule\UpdateByOutgoingRouting;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByOutgoingRoutingSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function let(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;

        $this->beConstructedWith($entityPersister);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByOutgoingRouting::class);
        throw new PendingException();
    }
}
