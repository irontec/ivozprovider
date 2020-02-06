<?php

namespace spec\Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class OutgoingDdiRulesPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let(
        MatchListInterface $matchList,
        OutgoingDdiRuleInterface $outgoingDdiRule
    ) {
        $this->dto = $dto = new OutgoingDdiRulesPatternDto();

        $dto->setType(
            OutgoingDdiRulesPatternInterface::TYPE_DESTINATION
        );
        $dto->setAction('force');
        $dto->setPriority(1);

        $this->hydrate(
            $dto,
            [
                'matchList' => $matchList->getWrappedObject(),
                'outgoingDdiRule' => $outgoingDdiRule->getWrappedObject(),
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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

        $this->hydrate(
            $this->dto,
            ['forcedDdi' => $ddi]
        );

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
                new \spec\DtoToEntityFakeTransformer()
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
        OutgoingDdiRuleInterface $outgoingDdiRule,
        CompanyInterface $company,
        DdiInterface $companyOutgoingDdi
    ) {
        $this
            ->dto
            ->setAction('keep');

        $outgoingDdiRule
            ->getCompany()
            ->wilLReturn($company);

        $outgoingDdiRule
            ->getId()
            ->willReturn(1);

        $company
            ->getOutgoingDdi()
            ->willReturn($companyOutgoingDdi);

        $this->hydrate(
            $this->dto,
            [
                'forcedDdi' => $ddi->getWrappedObject(),
                'outgoingDdiRule' => $outgoingDdiRule->getWrappedObject()
            ]
        );

        $this
            ->getForcedDdi()
            ->shouldBe($companyOutgoingDdi);
    }
}
