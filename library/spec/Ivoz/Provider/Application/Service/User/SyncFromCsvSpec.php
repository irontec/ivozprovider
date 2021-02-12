<?php

namespace spec\Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Application\Service\User\CsvStaticValidator;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Ddi\DdiFactory;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use Ivoz\Provider\Domain\Service\User\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SyncFromCsvSpec extends ObjectBehavior
{
    use HelperTrait;

    private $companyRepository;

    private $userFactory;
    private $user;
    private $terminalFactory;
    private $terminal;
    private $extensionFactory;
    private $extension;
    private $ddiFactory;
    private $ddi;

    private $entityTools;
    private $csvStaticValidator;

    private $company;
    private $csv = <<<EOCSV
Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002
John,Doe,jon@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,as002
EOCSV;

    public function let()
    {
        $this->company = $this->getInstance(
            Company::class,
            ['id' => 1]
        );

        $this->companyRepository = $this->getTestDouble(
            CompanyRepository::class
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

        $this->ddiFactory = $this->getTestDouble(
            DdiFactory::class
        );

        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );

        $this->csvStaticValidator = $this->getTestDouble(
            CsvStaticValidator::class
        );

        $this->beConstructedWith(
            $this->companyRepository,
            $this->userFactory,
            $this->terminalFactory,
            $this->extensionFactory,
            $this->ddiFactory,
            $this->entityTools,
            $this->csvStaticValidator
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SyncFromCsv::class);
    }

    function it_is_executable()
    {
        $this->prepreExecution();
        $this->execute($this->company, $this->csv);
    }

    function it_calls_user_factory()
    {
        $this->prepreExecution();

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
        $this->prepreExecution();

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
        $this->prepreExecution();

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                '2002',
                Argument::type(UserInterface::class)
            )
            ->shouldBeCalled()
            ->willReturn(
                $this->extension
            );

        $this->execute($this->company, $this->csv);
    }

    function it_calls_ddi_factory()
    {
        $this->prepreExecution();

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

    function it_propagates_factory_exceptions()
    {
        $this->prepreExecution();

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                $this->company->getId(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willThrow(
                new \Exception('Error message')
            );

        $expectedErrorMsg = <<<EOE
1 => Error message
2 => Error message
EOE;

        $this
            ->shouldThrow(
                new \Exception($expectedErrorMsg, 2)
            )
            ->during(
                'execute',
                [$this->company, $this->csv]
            );
    }

    private function prepreExecution()
    {
        $company = $this->getInstance(
            Company::class
        );

        $this
            ->companyRepository
            ->find(
                Argument::any()
            )
            ->willReturn(
                $company
            );

        // User
        $this->user = $this->getTestDouble(
            UserInterface::class
        );

        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willReturn(
                $this->user
            );

        // Terminal
        $this->terminal = $this->getTestDouble(
            TerminalInterface::class
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

        $this
            ->extensionFactory
            ->fromMassProvisioningCsv(
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
    }
}
