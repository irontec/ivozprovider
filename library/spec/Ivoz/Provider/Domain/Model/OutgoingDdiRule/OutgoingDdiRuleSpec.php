<?php

namespace spec\Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class OutgoingDdiRuleSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let(
        CompanyInterface $company
    ) {
        $this->dto = $dto = new OutgoingDdiRuleDto();

        $dto->setName('Name');
        $dto->setDefaultAction('force');

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
        $this->shouldHaveType(OutgoingDdiRule::class);
    }

    function it_keeps_value_when_default_action_is_force(
        DdiInterface $ddi
    ) {
        $ddi = $ddi->getWrappedObject();

        $this->hydrate(
            $this->dto,
            ['forcedDdi' => $ddi]
        );

        $this
            ->getForcedDdi()
            ->shouldBe($ddi);
    }

    function it_resets_forced_ddi_when_default_action_is_keep(
        DdiInterface $ddi
    ) {
        $this
            ->dto
            ->setDefaultAction('keep');

        $ddi = $ddi->getWrappedObject();

        $this->hydrate(
            $this->dto,
            ['forcedDdi' => $ddi]
        );

        $this
            ->getForcedDdi()
            ->shouldBe(null);
    }
}
