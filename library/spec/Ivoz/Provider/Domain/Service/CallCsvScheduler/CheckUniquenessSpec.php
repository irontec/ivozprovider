<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerRepository;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\CheckUniqueness;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckUniquenessSpec extends ObjectBehavior
{
    /**
     * @var CallCsvSchedulerRepository
     */
    protected $callCsvSchedulerRepository;

    public function let(CallCsvSchedulerRepository $callCsvSchedulerRepository)
    {
        $this->callCsvSchedulerRepository = $callCsvSchedulerRepository;

        $this->beConstructedWith(
            $callCsvSchedulerRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckUniqueness::class);
    }

    function it_throw_an_exception_on_duplicated_name(
        CallCsvSchedulerInterface $callCsvScheduler
    ) {
        $this->callCsvSchedulerRepository
            ->hasUniqueName($callCsvScheduler)
            ->willReturn(false);

        $this->shouldThrow(\DomainException::class)
            ->during('execute', [$callCsvScheduler, true]);
    }
}
