<?php

namespace spec\Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\NextExecutionResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class NextExecutionResolverSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith($entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NextExecutionResolver::class);
    }

    function it_sets_next_execution_if_empty(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        BrandInterface $brand,
        TimezoneInterface $timezone
    ) {
        $brand
            ->getDefaultTimezone()
            ->willReturn($timezone);

        $timezone
            ->getTz()
            ->willReturn('Europe/Madrid');

        $this->getterProphecy(
            $scheduler,
            [
                'getBrand' => $brand,
                'getNextExecution' => null,
                'getFrequency' => 1,
                'getUnit' => 'month'
            ]
        );

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto)
            ->shouldBeCalled();

        $schedulerDto
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->updateEntityByDto(
                $scheduler,
                $schedulerDto
            )->shouldBeCalled();

        $this->execute(
            $scheduler
        );
    }


    function it_updates_next_execution_if_lastExecution_has_changed(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto
    ) {
        $this->getterProphecy(
            $scheduler,
            [
                'getNextExecution' => new \DateTime(),
                'getInterval' => new \DateInterval('P1W')
            ]
        );

        $scheduler
            ->hasChanged('lastExecution')
            ->willReturn(true)
            ->shouldBeCalled();

        $scheduler
            ->hasChanged('nextExecution')
            ->willReturn(false)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto)
            ->shouldBeCalled();

        $schedulerDto
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->updateEntityByDto(
                $scheduler,
                $schedulerDto
            )->shouldBeCalled();

        $this->execute(
            $scheduler
        );
    }
}
