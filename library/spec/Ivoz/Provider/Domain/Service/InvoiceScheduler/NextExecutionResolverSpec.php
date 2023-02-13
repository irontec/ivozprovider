<?php

namespace spec\Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;
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
            ->willReturn($schedulerDto)
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

    function it_updates_next_execution_if_lastExecution_has_changed()
    {
        $schedulerDto = $this->getTestDouble(InvoiceSchedulerDto::class);
        $schedulerDto
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled()
            ->willReturn($schedulerDto->reveal());

        $scheduler = $this->getTestDouble(InvoiceScheduler::class);
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

        $scheduler
            ->getSchedulerDateTimeZone()
            ->willReturn(new \DateTimeZone('Europe/Madrid'))
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto)
            ->shouldBeCalled();



        $this
            ->entityTools
            ->updateEntityByDto(
                $scheduler->reveal(),
                $schedulerDto
            )->shouldBeCalled();

        $this->execute(
            $scheduler
        );
    }
}
