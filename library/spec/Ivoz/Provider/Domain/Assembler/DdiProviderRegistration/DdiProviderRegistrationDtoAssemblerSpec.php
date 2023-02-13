<?php

namespace spec\Ivoz\Provider\Domain\Assembler\DdiProviderRegistration;

use Ivoz\Kam\Domain\Model\TrunksUacreg\DdiProviderRegistrationStatus;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Assembler\DdiProviderRegistration\DdiProviderRegistrationDtoAssembler;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class DdiProviderRegistrationDtoAssemblerSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var TrunksClientInterface */
    protected $trunksClient;

    /** @var DdiProviderRegistrationInterface */
    protected $ddiProviderRegistration;

    /** @var DdiProviderRegistrationDto */
    protected $ddiProviderRegistrationDto;

    /** @var TrunksUacregInterface */
    protected $trunksUacreg;

    public function let(
        TrunksClientInterface $trunksClient,
        LoggerInterface $logger
    ) {
        $this->trunksClient = $trunksClient;

        $this->beConstructedWith(
            $trunksClient,
            $logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DdiProviderRegistrationDtoAssembler::class);
    }

    function it_does_nothing_on_empty_status()
    {
        $this->prepareExecution();

        $this->ddiProviderRegistration
            ->getTrunksUacreg()
            ->shouldNotBeCalled();

        $this
            ->toDto($this->ddiProviderRegistration)
            ->shouldReturn($this->ddiProviderRegistrationDto);
    }

    function it_sets_status_on_detailed_collection_context()
    {
        $this->prepareExecution();

        $this
            ->ddiProviderRegistrationDto
            ->setStatus(
                Argument::type(DdiProviderRegistrationStatus::class)
            )
            ->willReturn($this->ddiProviderRegistrationDto)
            ->shouldBeCalled();

        $this
            ->toDto(
                $this->ddiProviderRegistration,
                0,
                DdiProviderRegistrationDto::CONTEXT_DETAILED_COLLECTION
            )
            ->shouldReturn(
                $this->ddiProviderRegistrationDto
            );
    }

    protected function prepareExecution()
    {
        $this->ddiProviderRegistration = $this->getTestDouble(
            DdiProviderRegistrationInterface::class
        );
        $ddiProviderRegistration = $this->ddiProviderRegistration;

        $this->ddiProviderRegistrationDto = $this->getTestDouble(
            DdiProviderRegistrationDto::class
        );
        $dto = $this->ddiProviderRegistrationDto;

        $this->trunksUacreg = $this->getTestDouble(
            TrunksUacregInterface::class
        );
        $trunksUacreg = $this->trunksUacreg;


        $ddiProviderRegistration
            ->toDto(
                Argument::any()
            )
            ->willReturn($dto);

        $ddiProviderRegistration
            ->getTrunksUacreg()
            ->willReturn($trunksUacreg);

        $luuid = 'luuid';
        $trunksUacreg
            ->getLUuid()
            ->willReturn($luuid);

        $uacRegistrationInfo = [
            "flags" => 20,
            "diff_expires" => 938,
        ];
        $this
            ->trunksClient
            ->getUacRegistrationInfo($luuid)
            ->willReturn($uacRegistrationInfo);
    }
}
