<?php

namespace spec\Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Domain\Service\EntityTools;
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
            ->terminalRepository
            ->findOneByMac(
                Argument::any()
            )
            ->willReturn(null);

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

    function it_keeps_the_current_mac_and_model_when_columns_are_empty()
    {
        $this->prepareExecution();

        $this
            ->terminalRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any()
            )
            ->willReturn($this->terminal);

        $this
            ->entityTools
            ->entityToDto($this->terminal)
            ->willReturn(
                (new TerminalDto())
                    ->setMac('aabbccddeeff')
                    ->setTerminalModelId(3)
            );

        $this
            ->terminalModelRepository
            ->findOneByIden(Argument::any())
            ->shouldNotBeCalled();

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::that(function ($dto) {
                    return $dto instanceof TerminalDto
                        && $dto->getMac() === 'aabbccddeeff'
                        && $dto->getTerminalModelId() === 3;
                }),
                $this->terminal
            )
            ->shouldBeCalled()
            ->willReturn($this->terminal);

        $this->fromMassProvisioningCsv(
            1,
            'terminal',
            'Password*ABC123abc',
            '',
            ''
        );
    }

    function it_rejects_macs_that_belong_to_another_terminal()
    {
        $this->prepareExecution();

        $this
            ->terminalRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any()
            )
            ->willReturn($this->terminal);
        $this
            ->terminal
            ->getId()
            ->willReturn(1);

        $macOwner = $this->getTestDouble(
            Terminal::class
        );
        $this->getterProphecy(
            $macOwner,
            [
                'getId' => 2,
                'getCompany' => $this->company,
                'getName' => 'otherTerminal',
            ],
            false
        );

        $this
            ->terminalRepository
            ->findOneByMac('aa:bb:cc:dd:ee:ff')
            ->willReturn($macOwner);

        $this
            ->entityTools
            ->dtoToEntity(Argument::cetera())
            ->shouldNotBeCalled();

        $this
            ->shouldThrow(
                new \DomainException('MAC aa:bb:cc:dd:ee:ff already belongs to terminal otherTerminal')
            )
            ->during(
                'fromMassProvisioningCsv',
                $this->inputArgs
            );
    }

    function it_rejects_macs_of_another_company_terminal()
    {
        $this->prepareExecution();

        $this
            ->terminalRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any()
            )
            ->willReturn(null);

        $otherCompany = $this->getInstance(
            Company::class,
            ['id' => 2]
        );
        $macOwner = $this->getTestDouble(
            Terminal::class
        );
        $this->getterProphecy(
            $macOwner,
            [
                'getId' => 7,
                'getCompany' => $otherCompany,
            ],
            false
        );

        $this
            ->terminalRepository
            ->findOneByMac('aa:bb:cc:dd:ee:ff')
            ->willReturn($macOwner);

        $this
            ->entityTools
            ->dtoToEntity(Argument::cetera())
            ->shouldNotBeCalled();

        $this
            ->shouldThrow(
                new \DomainException('Mac already exists in another company\'s terminal')
            )
            ->during(
                'fromMassProvisioningCsv',
                $this->inputArgs
            );
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
