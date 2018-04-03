<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Service\Invoice\CheckValidity;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckValiditySpec extends ObjectBehavior
{

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function let(
        TrunksCdrRepository $trunksCdrRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->invoiveRepository = $invoiveRepository;

        $this->beConstructedWith($trunksCdrRepository, $invoiveRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckValidity::class);
    }
}
