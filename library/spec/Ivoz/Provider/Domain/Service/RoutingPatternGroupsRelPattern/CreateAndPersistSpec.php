<?php

namespace spec\Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\CreateAndPersist;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateAndPersistSpec extends ObjectBehavior
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
        $this->shouldHaveType(CreateAndPersist::class);
    }

    function it_creates_RoutingPatternGroupsRelPattern(
        RoutingPatternInterface $routingPattern,
        RoutingPatternGroupInterface $patternGroup
    ) {
        $this->entityPersister->persistDto(
            Argument::type(RoutingPatternGroupsRelPatternInterface::class)
        );

        $this->execute($routingPattern, $patternGroup);
    }
}
