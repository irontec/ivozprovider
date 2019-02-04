<?php

namespace spec\Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntry;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class IvrEntrySpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var IvrEntryDto
     */
    protected $dto;

    function let(
        CompanyInterface $company
    ) {
        $this->dto = $dto = new IvrEntryDto();
        $dto
            ->setEntry('Entry')
            ->setRouteType('number')
            ->setNumberValue('946002020');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IvrEntry::class);
    }

    function it_resets_targets_but_current(
        ExtensionInterface $extension,
        UserInterface $voiceMailUser,
        ConditionalRouteInterface $conditionalRoute
    ) {
        $dto = clone $this->dto;
        $dto
            ->setRouteType('number')
            ->setNumberValue('946002020');

        $this->hydrate(
            $dto,
            [
                'extension'        => $extension->getWrappedObject(),
                'voiceMailUser'    => $voiceMailUser->getWrappedObject(),
                'conditionalRoute' => $conditionalRoute->getWrappedObject()
            ]
        );

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getExtension()
            ->shouldBe(null);

        $this
            ->getVoiceMailUser()
            ->shouldBe(null);

        $this
            ->getConditionalRoute()
            ->shouldBe(null);
    }
}
