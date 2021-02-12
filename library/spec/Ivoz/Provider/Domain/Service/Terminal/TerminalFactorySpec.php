<?php

namespace spec\Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class TerminalFactorySpec extends ObjectBehavior
{
    use HelperTrait;

    protected $terminalRepository;
    protected $terminal;
    protected $terminalModelRepository;
    protected $terminalModel;
    protected $entityTools;

    // Input data
    protected $inputArgs = [
        1, /*company*/
        'name', /*name*/
        'pass', /*password*/
        'model', /*model*/
        'aa:bb:cc:dd:ee:ff' /*mac*/
    ];

    public function let(
        TerminalRepository $terminalRepository,
        TerminalModelRepository $terminalModelRepository,
        EntityTools $entityTools
    ) {
        $this->terminalRepository = $terminalRepository;
        $this->terminalModelRepository = $terminalModelRepository;
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->terminalRepository,
            $this->terminalModelRepository,
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TerminalFactory::class);
    }

    function it_searches_terminal_model()
    {
        $this->prepareExecution();

        $this
            ->terminalModelRepository
            ->findOneByName(
                Argument::any()
            )
            ->shouldBeCalled();

        $this->fromMassProvisioningCsv(
            ...$this->inputArgs
        );
    }

    function it_requires_terminal_model_to_exist()
    {
        $this
            ->terminalModelRepository
            ->findOneByName(
                Argument::type('string')
            )
            ->willReturn(null);

        $this
            ->shouldThrow(\Exception::class)
            ->duringFromMassProvisioningCsv(...$this->inputArgs);
    }

    function it_searches_for_existing_terminal()
    {
        $this->prepareExecution();

        $this
            ->terminalRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn($this->terminal);

        $this
            ->fromMassProvisioningCsv(
                ...$this->inputArgs
            )
            ->shouldReturn($this->terminal);
    }

    function it_creates_terminal_if_not_exists()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn($this->terminal);

        $this
            ->fromMassProvisioningCsv(
                ...$this->inputArgs
            )
            ->shouldReturn($this->terminal);
    }

    protected function prepareExecution()
    {
        $this->terminalModel = $this->getTestDouble(
            TerminalModel::class
        );

        $this
            ->terminalModelRepository
            ->findOneByName(
                Argument::any()
            )
            ->willReturn($this->terminalModel);

        $this->terminal = $this->getTestDouble(
            Terminal::class
        );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(TerminalDto::class)
            )
            ->willReturn($this->terminal);
    }
}
