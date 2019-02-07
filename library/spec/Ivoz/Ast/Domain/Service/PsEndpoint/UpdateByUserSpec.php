<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUser;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByUserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /////////////////////////////////
    ///
    /////////////////////////////////

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var PsEndpointInterface
     */
    protected $psEndpoint;

    /**
     * @var PsEndpointDto
     */
    protected $psEndpointDto;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith($entityTools);

        $this->prepareExecution();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUser::class);
    }

    function it_returns_on_empty_endpoint()
    {
        $this
            ->user
            ->getEndpoint()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->shouldNotBeCalled();

        $this->execute($this->user);
    }

    function it_sets_callerid()
    {
        $this->getterProphecy(
            $this->user,
            [
                'getFullName' => 'testName',
                'getExtensionNumber' => '214',
            ],
            true
        );

        $this
            ->psEndpointDto
            ->setCallerid('testName <214>')
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this->execute($this->user);
    }

    function it_sets_voicemail()
    {
        $this->getterProphecy(
            $this->user,
            [
                'getVoiceMail' => 'use@context',
            ],
            true
        );

        $this
            ->psEndpointDto
            ->setMailboxes('use@context')
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this->execute($this->user);
    }

    function prepareExecution()
    {
        $this->user = $this->getTestDouble(
            UserInterface::class
        );
        $this->psEndpoint = $this->getTestDouble(
            PsEndpointInterface::class
        );
        $this->psEndpointDto = $this->getTestDouble(
            PsEndpointDto::class
        );

        $this
            ->user
            ->getEndpoint()
            ->willReturn($this->psEndpoint);

        $this
            ->entityTools
            ->entityToDto($this->psEndpoint)
            ->willReturn($this->psEndpointDto);

        $this
            ->entityTools
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint,
                false
            )
            ->willReturn($this->psEndpoint);
    }
}
