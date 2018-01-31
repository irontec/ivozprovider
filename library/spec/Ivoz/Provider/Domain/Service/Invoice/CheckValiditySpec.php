<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Kam\Domain\Model\TrunksCdr\AccCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Service\Invoice\CheckValidity;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckValiditySpec extends ObjectBehavior
{
    /**
     * @var AccCdrRepository
     */
    protected $accCdrRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function let(
        AccCdrRepository $accCdrRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->accCdrRepository = $accCdrRepository;
        $this->invoiveRepository = $invoiveRepository;

        $this->beConstructedWith($accCdrRepository, $invoiveRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckValidity::class);
        throw new PendingException();
    }
}
