<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Service\Invoice\CheckValidity;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckValiditySpec extends ObjectBehavior
{

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function let(
        BillableCallRepository $billableCallRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->invoiveRepository = $invoiveRepository;

        $this->beConstructedWith($billableCallRepository, $invoiveRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckValidity::class);
    }
}
