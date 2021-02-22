<?php

namespace spec\Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
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
    protected $company;
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
            ->findOneByIden(
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
            ->findOneByIden(
                Argument::type('string')
            )
            ->willReturn(null);

        $this
            ->shouldThrow(\Exception::class)
            ->duringFromMassProvisioningCsv(...$this->inputArgs);
    }

    function it_searches_for_existing_terminal_by_name()
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


    function it_searches_for_existing_terminal_by_mac()
    {
        $this->prepareExecution();

        $this
            ->terminalRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any()
            )
            ->willReturn(
                null
            );

        $this
            ->terminalRepository
            ->findOneByMac(
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
                Argument::any(),
                null
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
            ->findOneByIden(
                Argument::any()
            )
            ->willReturn($this->terminalModel);

        $this->company = $this->getInstance(
            Company::class,
            [
                'id' => $this->inputArgs[0]
            ]
        );
        $this->terminal = $this->getTestDouble(
            Terminal::class
        );

        $this
            ->terminal
            ->getCompany()
            ->willReturn($this->company);


        $this
            ->entityTools
            ->entityToDto(
                Argument::type(TerminalInterface::class)
            )
            ->willReturn(
                new TerminalDto()
            );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(TerminalDto::class),
                Argument::any()
            )
            ->willReturn(
                $this->terminal
            );
    }
}
