<?php

namespace spec\Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\NextExecutionResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class NextExecutionResolverSpec extends ObjectBehavior
{
    use HelperTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(NextExecutionResolver::class);
    }

    function it_sets_next_execution_if_empty(
        InvoiceSchedulerInterface $scheduler,
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

        $scheduler
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this->execute(
            $scheduler,
            true
        );
    }


    function it_updates_next_execution_if_lastExecution_has_changed(
        InvoiceSchedulerInterface $scheduler
    ) {
        $this->getterProphecy(
            $scheduler,
            [
                'getNextExecution' => new \DateTime(),
                'getLastExecution' => new \DateTime(),
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
            ->setNextExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this->execute(
            $scheduler,
            true
        );
    }
}
