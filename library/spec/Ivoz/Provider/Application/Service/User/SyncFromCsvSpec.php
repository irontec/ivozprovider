<?php

namespace spec\Ivoz\Provider\Application\Service\User;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\User\User;
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

    private $userFactory;
    private $user;
    private $userDto;
    private $terminalFactory;
    private $terminal;
    private $terminalDto;
    private $extensionFactory;
    private $extension;
    private $extensionDto;
    private $ddiFactory;
    private $ddi;
    private $ddiDto;

    private $entityTools;
    private $csvStaticValidator;

    private $company;
    private $csv = <<<EOCSV
Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,,946002050,DDIProviderName

EOCSV;

    public function let()
    {
        $this->company = $this->getInstance(
            Company::class,
            ['id' => 1]
        );

        $this->userFactory = $this->getTestDouble(
            UserFactory::class,
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

    function it_propagates_factory_exceptions()
    {
        $this
            ->userFactory
            ->fromMassProvisioningCsv(
                companyId: Argument::any(),
                name: Argument::any(),
                lastName: Argument::any(),
                email: Argument::any(),
            )
            ->willThrow(
                new \Exception('Error message')
            );


        $expectedErrorMsg = <<<EOE
1 => Error message
EOE;

        $this
            ->shouldThrow(
                new \Exception($expectedErrorMsg, 1)
            )
            ->during(
                'execute',
                [$this->company, $this->csv]
            );
    }

    private function prepreExecution()
    {
        $this->user = $this->getTestDouble(User::class);
        $this->userDto = $this->getTestDouble(UserDto::class);
        $this->terminal = $this->getTestDouble(Terminal::class);
        $this->terminalDto = $this->getTestDouble(TerminalDto::class);
        $this->extension = $this->getTestDouble(Extension::class);
        $this->extensionDto = $this->getTestDouble(ExtensionDto::class);
        $this->ddi = $this->getTestDouble(Ddi::class);
        $this->ddiDto = $this->getTestDouble(DdiDto::class);

        $this->userFactory
            ->fromMassProvisioningCsv(
                companyId: $this->company->getId(),
                name: 'Name',
                lastName: 'Lastname',
                email: 'name@irontec.com',
            )
            ->willReturn($this->user);

        $this->terminalFactory
            ->fromMassProvisioningCsv(
                companyId: $this->company->getId(),
                name: 'terminalName',
                password: 'Z7+KJn8m3k',
                model: 'YealinkT21P_E2',
                mac: 'a00000000052',
            )
            ->shouldBeCalled(1)
            ->willReturn($this->terminal);

        $this->extensionFactory
            ->fromMassProvisioningCsv(
                companyId: $this->company->getId(),
                extensionNumber: '2002',
            )
            ->shouldBeCalled(2)
            ->willReturn($this->extension);

        $this->ddiFactory
            ->fromMassProvisioningCsv(
                $this->company,
                countryCode: '',
                ddiNumber: '946002050',
                ddiProviderName: 'DDIProviderName'
            )
            ->shouldBeCalled(2)
            ->willReturn($this->ddi);

        $this->entityTools
            ->entityToDto($this->user)
            ->willReturn($this->userDto)
            ->shouldBeCalled(1);

        $this->entityTools
            ->entityToDto($this->terminal)
            ->willReturn($this->terminalDto)
            ->shouldBeCalled(1);

        $this->entityTools
            ->entityToDto($this->extension)
            ->willReturn($this->extensionDto)
            ->shouldBeCalled(1);

        $this->entityTools
            ->entityToDto($this->ddi)
            ->willReturn($this->ddiDto)
            ->shouldBeCalled(1);

        $this->entityTools
            ->persistDto($this->userDto, $this->user)
            ->willReturn($this->user)
            ->shouldBeCalled(1);

        $endpoint = $this->getTestDouble(PsEndpointInterface::class);
        $endpointDto = $this->getTestDouble(PsEndpointDto::class);

        $this->user
            ->getEndpoint()
            ->willReturn($endpoint)
            ->shouldBeCalled(1);

        $this->user
            ->getExtensionNumber()
            ->willReturn('2002')
            ->shouldBeCalled(1);

        $this->user
            ->getFullName()
            ->willReturn('Name Lastname')
            ->shouldBeCalled(1);

        $this->entityTools
            ->entityToDto($endpoint)
            ->willReturn($endpointDto)
            ->shouldBeCalled(1);

        $this->entityTools
            ->persistDto($endpointDto, $endpoint)
            ->willReturn($endpoint)
            ->shouldBeCalled(1);
    }
}
