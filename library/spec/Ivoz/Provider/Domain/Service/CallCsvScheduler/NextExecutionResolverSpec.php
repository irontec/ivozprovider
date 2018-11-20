<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\NextExecutionResolver;
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

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NextExecutionResolver::class);
    }

    function it_sets_next_execution_if_empty(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto,
        TimezoneInterface $timezone
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $timezone
        );

        $schedulerDto
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this->execute($scheduler);
    }


    function it_updates_next_execution(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto
    ) {
        $this->prepareUpdateExecution(
            $scheduler,
            $schedulerDto
        );

        $schedulerDto
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this->execute($scheduler);
    }


    protected function prepareExecution(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto,
        TimezoneInterface $timezone
    ) {
        $this->getterProphecy(
            $scheduler,
            [
                'getNextExecution' => null,
                'getTimezone' => $timezone,
                'getFrequency' => 1,
                'getUnit' => 'week'
            ],
            false
        );

        $timezone
            ->getTz()
            ->willReturn('UTC');

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto);

        $this
            ->entityTools
            ->updateEntityByDto(
                $scheduler,
                $schedulerDto
            )
            ->willReturn(null);
    }


    protected function prepareUpdateExecution(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto
    ) {
        $this->getterProphecy(
            $scheduler,
            [
                'getNextExecution' => null,
                'getNextExecution' => new \DateTime('2025-01-01 01:01:01'),
                'getInterval' =>  new \DateInterval('P1W')
            ],
            false
        );

        $scheduler
            ->hasChanged('lastExecution')
            ->willReturn(true);

        $scheduler
            ->hasChanged('nextExecution')
            ->willReturn(false);

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto);

        $this
            ->entityTools
            ->updateEntityByDto(
                $scheduler,
                $schedulerDto
            )
            ->willReturn(null);
    }
}
