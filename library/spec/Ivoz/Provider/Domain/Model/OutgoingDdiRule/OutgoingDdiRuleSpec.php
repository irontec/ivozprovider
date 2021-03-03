<?php

namespace spec\Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class OutgoingDdiRuleSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var OutgoingDdiRuleDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        CompanyInterface $company
    ) {
        $this->dto = $dto = new OutgoingDdiRuleDto();

        $companyDto = new CompanyDto();
        $dto
            ->setName('Name')
            ->setDefaultAction('force')
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company->getWrappedObject()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OutgoingDdiRule::class);
    }

    function it_keeps_value_when_default_action_is_force(
        DdiInterface $ddi
    ) {
        $ddiDto = new DdiDto();
        $this
            ->dto
            ->setForcedDdi($ddiDto);

        $this->transformer->appendFixedTransforms([
            [$ddiDto, $ddi->getWrappedObject()]
        ]);

        $this
            ->getForcedDdi()
            ->shouldBe($ddi);
    }

    function it_resets_forced_ddi_when_default_action_is_keep(
        DdiInterface $ddi
    ) {
        $ddiDto = new DdiDto();

        $this
            ->dto
            ->setDefaultAction('keep')
            ->setForcedDdi($ddiDto);

        $this->transformer->appendFixedTransforms([
            [$ddiDto, $ddi->getWrappedObject()]
        ]);

        $this
            ->getForcedDdi()
            ->shouldBe(null);
    }
}
