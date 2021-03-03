<?php

namespace spec\Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class OutgoingDdiRulesPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var OutgoingDdiRulesPatternDto
     */
    protected $dto;

    /**
     * @var OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        MatchListInterface $matchList,
        OutgoingDdiRuleInterface $outgoingDdiRule
    ) {
        $this->outgoingDdiRule = $outgoingDdiRule;

        $matchListDto = new MatchListDto();
        $outgoingDdiRuleDto = new OutgoingDdiRuleDto();
        $this->dto = $dto = new OutgoingDdiRulesPatternDto();

        $dto
            ->setType(
                OutgoingDdiRulesPatternInterface::TYPE_DESTINATION
            )
            ->setAction('force')
            ->setPriority(1)
            ->setMatchList($matchListDto)
            ->setOutgoingDdiRule($outgoingDdiRuleDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$matchListDto, $matchList->getWrappedObject()],
            [$outgoingDdiRuleDto, $outgoingDdiRule->getWrappedObject()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OutgoingDdiRulesPattern::class);
    }

    function it_keeps_value_when_default_action_is_force(
        DdiInterface $ddi
    ) {
        $ddi = $ddi->getWrappedObject();
        $ddiDto = new DdiDto();

        $this
            ->dto
            ->setForcedDdi($ddiDto);

        $this
            ->transformer
            ->appendFixedTransforms([
                [$ddiDto, $ddi]
            ]);

        $this
            ->getForcedDdi()
            ->shouldBe($ddi);
    }

    function it_throws_exception_on_invalid_prefix_format()
    {
        $this
            ->dto
            ->setType(OutgoingDdiRulesPatternInterface::TYPE_PREFIX);

        $validPrefixes = [
            '1*', '12*', '123*'
        ];

        foreach ($validPrefixes as $validPrefix) {
            $this
                ->dto
                ->setPrefix($validPrefix);

            $response = $this->updateFromDto(
                $this->dto,
                $this->transformer
            );

            $this
                ->getPrefix($validPrefix)
                ->shouldReturn($validPrefix);
        }

        $invalidPrefixes = [
            null,
            '',
            '123',
            '1234*'
        ];

        foreach ($invalidPrefixes as $invalidPrefix) {
            $this
                ->dto
                ->setPrefix($invalidPrefix);

            $this
                ->shouldThrow('\Exception')
                ->during(
                    'updateFromDto',
                    [
                        $this->dto,
                        new \spec\DtoToEntityFakeTransformer()
                    ]
                );
        }
    }

    function it_return_company_outgoing_ddi_when_no_forced_ddi(
        DdiInterface $ddi,
        CompanyInterface $company,
        DdiInterface $companyOutgoingDdi
    ) {
        $this->getterProphecy(
            $this->outgoingDdiRule,
            [
                'getId' => 1,
                'getCompany' => $company->getWrappedObject(),
            ]
        );

        $this->getterProphecy(
            $company,
            [
                'getOutgoingDdi' => $companyOutgoingDdi->getWrappedObject(),
            ]
        );

        $this
            ->getForcedDdi()
            ->shouldBe($companyOutgoingDdi);
    }
}
