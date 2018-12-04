<?php

namespace spec\Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class IvrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let(
        CompanyInterface $company
    ) {
        $this->dto = $dto = new IvrDto();
        $dto
            ->setName('Name')
            ->setTimeout(5)
            ->setMaxDigits(2)
            ->setAllowExtensions(1);

        $this->hydrate(
            $dto,
            [
                'company' => $company->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Ivr::class);
    }

    function it_resets_no_input_targets_but_current(
        UserInterface $timeoutVoiceMailUser,
        ExtensionInterface $timeoutExtension
    ) {
        $this->hydrate(
            $this->dto,
            [
                'noInputNumberValue'   => '1234',
                'noInputExtension'     => $timeoutExtension->getWrappedObject(),
                'noInputVoiceMailUser' => $timeoutVoiceMailUser->getWrappedObject()
            ]
        );

        $this
            ->getNoInputExtension()
            ->shouldBe(null);

        $this
            ->getNoInputVoiceMailUser()
            ->shouldBe(null);
    }

    function it_resets_error_targets_but_current(
        UserInterface $timeoutVoiceMailUser,
        ExtensionInterface $timeoutExtension
    ) {
        $this->hydrate(
            $this->dto,
            [
                'errorNumberValue'   => '1234',
                'errorExtension'   => $timeoutExtension->getWrappedObject(),
                'errorVoiceMailUser' =>  $timeoutVoiceMailUser->getWrappedObject()
            ]
        );

        $this
            ->getErrorExtension()
            ->shouldBe(null);

        $this
            ->getErrorVoiceMailUser()
            ->shouldBe(null);
    }
}
