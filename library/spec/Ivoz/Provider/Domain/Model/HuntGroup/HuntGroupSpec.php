<?php

namespace spec\Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

class HuntGroupSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let(
        CompanyInterface $company
    ) {
        $this->dto = $dto = new HuntGroupDto();
        $dto
            ->setName('name')
            ->setDescription('Description')
            ->setStrategy('ringAll')
            ->setRingAllTimeout(1);

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
        $this->shouldHaveType(HuntGroup::class);
    }

    function it_resets_noAnswer_targets_but_current(
        UserInterface $noAnswerVoiceMailUser,
        ExtensionInterface $noAnswerExtension
    ) {
        $this
            ->dto
            ->setNoAnswerTargetType('number');

        $this->hydrate(
            $this->dto,
            [
                'noAnswerNumberValue'   => '1234',
                'noAnswerExtension'     => $noAnswerExtension->getWrappedObject(),
                'noAnswerVoiceMailUser' => $noAnswerVoiceMailUser->getWrappedObject()
            ]
        );

        $this
            ->getNoAnswerExtension()
            ->shouldBe(null);

        $this
            ->getNoAnswerVoiceMailUser()
            ->shouldBe(null);
    }
}
