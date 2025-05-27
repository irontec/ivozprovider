<?php

namespace spec\Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\SetExecutionError;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SetExecutionErrorSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    function let(
        EntityTools $entityTools,
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith($entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SetExecutionError::class);
    }


    function it_sets_resets_error_count_on_success()
    {
        $schedulerDto = $this->getTestDouble(InvoiceSchedulerDto::class);
        $schedulerDto
            ->setErrorCount(0)
            ->shouldBeCalled()
            ->willReturn($schedulerDto->reveal());

        $scheduler = $this->getTestDouble(InvoiceScheduler::class);
        $this->getterProphecy(
            $scheduler,
            [
                'getErrorCount' => 2,
            ]
        );

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
            $scheduler,
            null
        );
    }

    function it_sets_resets_error_count_on_max_errors_reached()
    {
        $schedulerDto = $this->getTestDouble(InvoiceSchedulerDto::class);
        $schedulerDto
            ->setErrorCount(0)
            ->shouldBeCalled()
            ->willReturn($schedulerDto->reveal());

        $scheduler = $this->getTestDouble(InvoiceScheduler::class);
        $this->getterProphecy(
            $scheduler,
            [
                'getErrorCount' => 3,
            ]
        );

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
            $scheduler,
            'error message'
        );
    }

    function it_increases_error_count_on_error()
    {
        $schedulerDto = $this->getTestDouble(InvoiceSchedulerDto::class);
        $schedulerDto
            ->setErrorCount(1)
            ->shouldBeCalled()
            ->willReturn($schedulerDto->reveal());

        $scheduler = $this->getTestDouble(InvoiceScheduler::class);
        $this->getterProphecy(
            $scheduler,
            [
                'getErrorCount' => 0,
            ]
        );

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
            $scheduler,
            'error message'
        );
    }
}
