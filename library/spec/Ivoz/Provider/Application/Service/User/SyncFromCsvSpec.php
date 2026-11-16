<?php

namespace spec\Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Ddi\DdiFactory;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use Ivoz\Provider\Domain\Service\User\CsvRowsParser;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use Ivoz\Provider\Domain\Service\User\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class SyncFromCsvSpec extends ObjectBehavior
{
    use HelperTrait;

    private $userFactory;
    private $user;
    private $secondUser;
    private $terminalFactory;
    private $terminal;
    private $extensionFactory;
    private $extensionRepository;
    private $extension;
    private $ddiFactory;
    private $ddi;

    private $entityTools;
    private $csvStaticValidator;
    private $csvRowsParser;
    private $logger;

    private $company;

    private $csv = <<<EOCSV
Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002
John,Doe,jon@irontec.com,,,,,,,,
EOCSV;

    public function let()
    {
        $this->company = $this->getInstance(
            Company::class,
            ['id' => 1]
        );

        $this->userFactory = $this->getTestDouble(
            UserFactory::class
        );

        $this->terminalFactory = $this->getTestDouble(
            TerminalFactory::class
        );

        $this->extensionFactory = $this->getTestDouble(
            ExtensionFactory::class
        );

        $this->extensionRepository = $this->getTestDouble(
            ExtensionRepository::class
        );

        $this
            ->extensionRepository
            ->findCompanyExtension(
                Argument::any(),
                Argument::any()
            )
            ->willReturn(null);

        $this->ddiFactory = $this->getTestDouble(
            DdiFactory::class
        );

        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );

        $this->logger = $this->getTestDouble(
            LoggerInterface::class
        );

        $this->csvStaticValidator = $this->getTestDouble(
            CsvStaticValidator::class
        );

        $this->csvRowsParser = $this->getTestDouble(
            CsvRowsParser::class
        );

        $this
            ->csvRowsParser
            ->parse(Argument::type('string'))
            ->willReturn(
                array_map('str_getcsv', explode("\n", $this->csv))
            );

        $this->beConstructedWith(
            $this->userFactory,
            $this->terminalFactory,
            $this->extensionFactory,
            $this->extensionRepository,
            $this->ddiFactory,
            $this->entityTools,
            $this->csvStaticValidator,
            $this->csvRowsParser,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SyncFromCsv::class);
    }

    function it_calls_user_factory()
    {
        $this->prepareExecution();

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                'Name',
                'Lastname',
                'name@irontec.com'
            )
            ->shouldBeCalled()
            ->willReturn(
                $this->user
            );

        $this->execute($this->company, $this->csv);
    }

    function it_calls_terminal_factory()
    {
        $this->prepareExecution();

        $this
            ->terminalFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                'terminalName',
                'Z7+KJn8m3k',
                'YealinkT21P_E2',
                'a00000000052'
            )
            ->shouldBeCalled()
            ->willReturn(
                $this->terminal
            );

        $this->execute($this->company, $this->csv);
    }

    function it_calls_extension_factory()
    {
        $this->prepareExecution();

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                '2002'
            )
            ->shouldBeCalled()
            ->willReturn(
                $this->extension
            );

        $this->execute($this->company, $this->csv);
    }

    function it_calls_ddi_factory()
    {
        $this->prepareExecution();

        $this
            ->ddiFactory
            ->fromMassProvisioningCsv(
                Argument::type(CompanyInterface::class),
                'ES',
                '946002050',
                'as002'
            )
            ->shouldBeCalled()
            ->willReturn(
                $this->ddi
            );

        $this->execute($this->company, $this->csv);
    }

    function it_persists_terminal_extension_and_ddi_before_the_user()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persist($this->terminal, true)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persist($this->extension, true)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persist($this->ddi, true)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistFromArray(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($this->company, $this->csv);
    }

    function it_links_row_entities_to_the_user_through_its_dto()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                Argument::that(function ($dto) {
                    return $dto instanceof UserDto
                        && $dto->getTerminalId() === 7
                        && $dto->getExtensionId() === 8
                        && $dto->getOutgoingDdiId() === 9;
                }),
                $this->user,
                true
            )
            ->shouldBeCalled()
            ->willReturn($this->user);

        $this->execute($this->company, $this->csv);
    }

    function it_does_not_carry_terminal_extension_or_ddi_into_the_next_row()
    {
        $this->prepareExecution();

        $this
            ->terminalFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldBeCalledOnce()
            ->willReturn($this->terminal);

        $this
            ->entityTools
            ->persistDto(
                Argument::that(function ($dto) {
                    return $dto instanceof UserDto
                        && $dto->getTerminalId() === null
                        && $dto->getExtensionId() === null
                        && $dto->getOutgoingDdiId() === null;
                }),
                $this->secondUser,
                true
            )
            ->shouldBeCalled()
            ->willReturn($this->secondUser);

        $this->execute($this->company, $this->csv);
    }

    function it_routes_new_ddis_to_the_user()
    {
        $this->prepareExecution();

        $this->getterProphecy(
            $this->user,
            ['getId' => 5],
            false
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::that(function ($dto) {
                    return $dto instanceof DdiDto
                        && $dto->getUserId() === 5
                        && $dto->getRouteType() === DdiInterface::ROUTETYPE_USER;
                }),
                $this->ddi,
                true
            )
            ->shouldBeCalled()
            ->willReturn($this->ddi);

        $this->execute($this->company, $this->csv);
    }

    function it_does_not_reroute_existing_ddis()
    {
        $this->prepareExecution();

        $this->getterProphecy(
            $this->ddi,
            ['isNew' => false],
            false
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(DdiDto::class),
                Argument::cetera()
            )
            ->shouldNotBeCalled();

        $this->execute($this->company, $this->csv);
    }

    function it_writes_nothing_of_a_row_whose_factories_fail()
    {
        $this->prepareExecution();

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                '2002',
                null
            )
            ->willThrow(
                new \DomainException('Country not found')
            );

        $this
            ->entityTools
            ->persist($this->terminal, Argument::any())
            ->shouldNotBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(UserDto::class),
                $this->user,
                Argument::any()
            )
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 1, 'message' => 'Country not found'],
            ]);
    }

    function it_rejects_extensions_assigned_to_another_user()
    {
        $this->prepareExecution();

        $owner = $this->getTestDouble(UserInterface::class);
        $this->getterProphecy($owner, ['getId' => 9], false);

        $assignedExtension = $this->getTestDouble(ExtensionInterface::class);
        $this->getterProphecy(
            $assignedExtension,
            [
                'getRouteType' => ExtensionInterface::ROUTETYPE_USER,
                'getUser' => $owner,
                'getNumber' => '2002',
            ],
            false
        );

        $this
            ->extensionRepository
            ->findCompanyExtension($this->company->getId(), '2002')
            ->willReturn($assignedExtension);

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldNotBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(UserDto::class),
                $this->user,
                Argument::any()
            )
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 1, 'message' => 'Extension 2002 is already assigned to another user'],
            ]);
        $result->getCreatedCount()->shouldReturn(1);
    }

    function it_rejects_extensions_routed_elsewhere()
    {
        $this->prepareExecution();

        $queueExtension = $this->getTestDouble(ExtensionInterface::class);
        $this->getterProphecy(
            $queueExtension,
            [
                'getRouteType' => ExtensionInterface::ROUTETYPE_QUEUE,
                'getUser' => null,
                'getNumber' => '2002',
            ],
            false
        );

        $this
            ->extensionRepository
            ->findCompanyExtension($this->company->getId(), '2002')
            ->willReturn($queueExtension);

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 1, 'message' => 'Extension 2002 is already routed to a queue'],
            ]);
        $result->getCreatedCount()->shouldReturn(1);
    }

    function it_accepts_extensions_already_assigned_to_the_same_user()
    {
        $this->prepareExecution();

        $this->getterProphecy(
            $this->user,
            ['getId' => 5],
            false
        );

        $assignedExtension = $this->getTestDouble(ExtensionInterface::class);
        $this->getterProphecy(
            $assignedExtension,
            [
                'getRouteType' => ExtensionInterface::ROUTETYPE_USER,
                'getUser' => $this->user,
                'getNumber' => '2002',
            ],
            false
        );

        $this
            ->extensionRepository
            ->findCompanyExtension($this->company->getId(), '2002')
            ->willReturn($assignedExtension);

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                '2002'
            )
            ->shouldBeCalled()
            ->willReturn($this->extension);

        $result = $this->execute($this->company, $this->csv);

        $result->getErrors()->shouldReturn([]);
    }

    function it_rejects_terminals_assigned_to_another_user()
    {
        $this->prepareExecution();

        $owner = $this->getTestDouble(UserInterface::class);
        $this->getterProphecy($owner, ['getId' => 9], false);
        $this->getterProphecy(
            $this->terminal,
            ['getUser' => $owner, 'getName' => 'terminalName'],
            false
        );

        $this
            ->entityTools
            ->persist($this->terminal, Argument::any())
            ->shouldNotBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(UserDto::class),
                $this->user,
                Argument::any()
            )
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 1, 'message' => 'Terminal terminalName is already assigned to another user'],
            ]);
        $result->getCreatedCount()->shouldReturn(1);
    }

    function it_accepts_terminals_already_assigned_to_the_same_user()
    {
        $this->prepareExecution();

        $this->getterProphecy(
            $this->user,
            ['getId' => 5],
            false
        );
        $this->getterProphecy(
            $this->terminal,
            ['getUser' => $this->user],
            false
        );

        $this
            ->entityTools
            ->persist($this->terminal, true)
            ->shouldBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result->getErrors()->shouldReturn([]);
    }

    function it_reports_row_errors_by_line_and_keeps_importing_the_rest()
    {
        $this->prepareExecution();

        $this
            ->terminalFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                'terminalName',
                'Z7+KJn8m3k',
                'YealinkT21P_E2',
                'a00000000052'
            )
            ->willThrow(
                new \DomainException('terminal model not found')
            );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(UserDto::class),
                $this->secondUser,
                true
            )
            ->shouldBeCalled()
            ->willReturn($this->secondUser);

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 1, 'message' => 'terminal model not found'],
            ]);
        $result->getCreatedCount()->shouldReturn(1);
        $result->getUpdatedCount()->shouldReturn(0);
    }

    function it_counts_created_and_updated_users()
    {
        $this->prepareExecution();

        $this->getterProphecy(
            $this->user,
            ['getId' => 5],
            false
        );

        $result = $this->execute($this->company, $this->csv);

        $result->getCreatedCount()->shouldReturn(1);
        $result->getUpdatedCount()->shouldReturn(1);
        $result->getErrors()->shouldReturn([]);
    }

    function it_reports_file_level_errors_on_line_zero_without_importing()
    {
        $this->prepareExecution();

        $this
            ->csvStaticValidator
            ->execute(Argument::any())
            ->willThrow(
                new \DomainException('Duplicated full name found: Name Lastname')
            );

        $this
            ->userFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 0, 'message' => 'Duplicated full name found: Name Lastname'],
            ]);
    }

    function it_reports_parser_errors_on_line_zero()
    {
        $this->prepareExecution();

        $this
            ->csvRowsParser
            ->parse(Argument::type('string'))
            ->willThrow(
                new \DomainException('The file is empty')
            );

        $this
            ->userFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, '');

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 0, 'message' => 'The file is empty'],
            ]);
    }

    function it_stops_after_an_unexpected_error_and_marks_remaining_rows_as_not_processed()
    {
        $this->prepareExecution();

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                'Name',
                'Lastname',
                'name@irontec.com'
            )
            ->willThrow(
                new \RuntimeException('The EntityManager is closed.')
            );

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                'John',
                'Doe',
                'jon@irontec.com'
            )
            ->shouldNotBeCalled();

        $this
            ->logger
            ->error(
                Argument::containingString('The EntityManager is closed.'),
                Argument::any()
            )
            ->shouldBeCalled();

        $result = $this->execute($this->company, $this->csv);

        $result
            ->getErrors()
            ->shouldReturn([
                ['line' => 1, 'message' => 'Unknown error'],
                ['line' => 2, 'message' => 'Not processed: the import stopped after an unexpected error at line 1'],
            ]);
    }

    private function prepareExecution()
    {
        $this->user = $this->getTestDouble(
            UserInterface::class
        );

        $this->secondUser = $this->getTestDouble(
            UserInterface::class
        );

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                Argument::any(),
                'Name',
                'Lastname',
                Argument::any()
            )
            ->willReturn(
                $this->user
            );

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                Argument::any(),
                'John',
                'Doe',
                Argument::any()
            )
            ->willReturn(
                $this->secondUser
            );

        // Terminal
        $this->terminal = $this->getTestDouble(
            TerminalInterface::class
        );

        $this->getterProphecy(
            $this->terminal,
            ['getId' => 7],
            false
        );

        $this
            ->terminalFactory
            ->fromMassProvisioningCsv(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willReturn(
                $this->terminal
            );

        // Extension
        $this->extension = $this->getTestDouble(
            ExtensionInterface::class
        );

        $this->getterProphecy(
            $this->extension,
            ['getId' => 8],
            false
        );

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willReturn(
                $this->extension
            );

        // Ddi
        $this->ddi = $this->getTestDouble(
            DdiInterface::class
        );

        $this->getterProphecy(
            $this->ddi,
            [
                'getId' => 9,
                'isNew' => true,
            ],
            false
        );

        $this
            ->ddiFactory
            ->fromMassProvisioningCsv(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willReturn(
                $this->ddi
            );

        $this
            ->entityTools
            ->entityToDto(Argument::type(UserInterface::class))
            ->will(function () {
                return new UserDto();
            });

        $this
            ->entityTools
            ->entityToDto(Argument::type(DdiInterface::class))
            ->will(function () {
                return new DdiDto();
            });

        $this
            ->entityTools
            ->persistDto(
                Argument::type(UserDto::class),
                Argument::type(UserInterface::class),
                Argument::any()
            )
            ->will(function ($args) {
                return $args[1];
            });

        $this
            ->entityTools
            ->persistDto(
                Argument::type(DdiDto::class),
                Argument::type(DdiInterface::class),
                Argument::any()
            )
            ->will(function ($args) {
                return $args[1];
            });
    }
}
