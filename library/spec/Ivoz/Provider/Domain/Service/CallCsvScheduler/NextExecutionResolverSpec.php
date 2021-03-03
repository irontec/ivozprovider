<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\NextExecutionResolver;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class NextExecutionResolverSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    public function letGo()
    {
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
        $this
            ->prepareExecution(
                $scheduler,
                $schedulerDto
            );

        $schedulerDto
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->willReturn($schedulerDto)
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
            ->willReturn($schedulerDto)
            ->shouldBeCalled();

        $this->execute($scheduler);
    }

    function it_considers_dst_changes_on_updates(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto
    ) {

        $oneDayInterval = \DateInterval::createFromDateString('1 day');

        // Europe/Madrid: Current => Expected (Comment)
        // UTC: Current => Expected
        $dataSet = [
            // 2019-10-25 02:00:00 => 2019-10-26 02:00:00
            '2019-10-25 00:00:00' => '2019-10-26 00:00:00',

            // 2019-10-26 02:00:00 => 2019-10-27 02:00:00
            '2019-10-26 00:00:00' => '2019-10-27 01:00:00',

            /*
             * Both 2019-10-27 02:00:00 => 2019-10-28 02:00:00
             */
            '2019-10-27 00:00:00' => '2019-10-28 01:00:00',
            '2019-10-27 01:00:00' => '2019-10-28 01:00:00',

            // 2020-03-27 02:00:00 =>  2020-03-28 02:00:00
            '2020-03-27 01:00:00' => '2020-03-28 01:00:00',

            /*
             * 2020-03-28 02:00:00 and 03:00:00 => 2020-03-29 03:00:00
             */
            '2020-03-28 01:00:00' => '2020-03-29 01:00:00',
            '2020-03-28 02:00:00' => '2020-03-29 01:00:00',

            // 2020-03-29 03:00:00 => 2020-03-30 03:00:00
            '2020-03-29 01:00:00' => '2020-03-30 01:00:00',
        ];

        foreach ($dataSet as $currentNextExecution => $expectedNextExecution) {
            $scheduler = $this->getTestDouble(
                CallCsvSchedulerInterface::class,
                false
            );

            $schedulerDto = $this->getTestDouble(
                CallCsvSchedulerDto::class,
                false
            );

            $this->prepareUpdateExecution(
                $scheduler,
                $schedulerDto
            );

            $this->getterProphecy(
                $scheduler,
                [
                    'getInterval' => $oneDayInterval,
                ],
                true
            );

            $nextExecution = new \DateTime(
                $currentNextExecution,
                new \DateTimeZone('UTC')
            );
            $expectedValue = &$expectedNextExecution;

            $this->getterProphecy(
                $scheduler,
                [
                    'getNextExecution' => $nextExecution,
                ],
                true
            );

            $schedulerDto
                ->setNextExecution(
                    $this->getNextExecutionValidator(
                        $currentNextExecution,
                        $expectedNextExecution
                    )
                )
                ->willReturn($schedulerDto)
                ->shouldBeCalled();

            $this->execute($scheduler);
        }
    }

    protected function getNextExecutionValidator($currentNextExecution, $expectedNextExecution)
    {
        return Argument::that(
            function (\DateTime $updatedExecutionTime) use ($expectedNextExecution) {

                if ($updatedExecutionTime->getTimezone()->getName() !== 'UTC') {
                    throw new FailureException('Timezone must be UTC');
                }

                $currentValue = $updatedExecutionTime->format('Y-m-d H:i:s');

                if ($currentValue !== $expectedNextExecution) {
                    throw new FailureException(
                        sprintf(
                            'Unexpected next exeution time value. %s was expected, %s found',
                            $expectedNextExecution,
                            $currentValue
                        )
                    );
                }

                return true;
            }
        );
    }

    protected function prepareExecution(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto
    ) {
        $timezone = $this->getInstance(
            Timezone::class,
            [
                'tz' => 'UTC'
            ]
        );

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
            ->willReturn($scheduler);
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

        $scheduler
            ->getSchedulerDateTimeZone()
            ->willReturn(new \DateTimeZone('Europe/Madrid'))
            ->shouldBeCalled();

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
            ->willReturn($scheduler);
    }
}
