<?php

namespace spec\Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateInRules;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenerateInRulesSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function let(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;

        $this->beConstructedWith(...func_get_args());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GenerateInRules::class);
    }

    function it_creates_internationalToE164_rule(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepareInternationalToE164Prophecy();

        $this->execute($entity, 'callerin');
    }

    function it_creates_nationalToE164_rule(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepareNationalToE164Prophecy();

        $this->execute($entity, 'callerin');
    }

    function it_doesnt_create_outOfAreaNationalToE164_rule_if_trunkPrefix_is_empty(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);
        $trunkPrefix = '';
        $entity
            ->getTrunkPrefix()
            ->willReturn($trunkPrefix);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepareOutOfAreaNationalToE164Prophecy($trunkPrefix, false);

        $this->execute($entity, 'callerin');
    }


    function it_creates_outOfAreaNationalToE164_rule_if_trunkPrefix_is_not_empty(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);
        $trunkPrefix = '0';
        $entity
            ->getTrunkPrefix()
            ->willReturn($trunkPrefix);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepareOutOfAreaNationalToE164Prophecy($trunkPrefix, true);

        $this->execute($entity, 'callerin');
    }

    function it_doesnt_create_withinNationalToE164_rule_if_areaCode_is_empty(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);
        $nationalLen = 9;
        $entity
            ->getNationalLen()
            ->willReturn($nationalLen);

        $areaCode = '';
        $entity
            ->getAreaCode()
            ->willReturn($areaCode);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepareWithinNationalToE164Prophecy($nationalLen, $areaCode, false);

        $this->execute($entity, 'callerin');
    }

    function it_creates_withinNationalToE164_rule_if_areaCode_is_not_empty(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);
        $nationalLen = 9;
        $entity
            ->getNationalLen()
            ->willReturn($nationalLen);

        $areaCode = '94';
        $entity
            ->getAreaCode()
            ->willReturn($areaCode);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepareWithinNationalToE164Prophecy($nationalLen, $areaCode);

        $this->execute($entity, 'callerin');
    }


    private function prepareEntityBehaviour(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $entity
            ->getId()
            ->willReturn(1);

        $entity
            ->getInternationalCode()
            ->willReturn('00');

        $entity
            ->getCountry()
            ->willReturn($country);

        $country
            ->getCountryCode()
            ->willReturn('34');

        $entity
            ->getTrunkPrefix()
            ->willReturn('');

        $entity
            ->getAreaCode()
            ->willReturn('');

        $entity
            ->getNationalLen()
            ->willReturn(9);
    }

    private function setExpectedOutcome($expected, $shouldHappen = true)
    {
        $prophecy = $this
            ->entityPersister
            ->persistDto(Argument::that(function ($input) use ($expected) {

                $inputArray = $input->toArray();
                $expectedArray = $expected->toArray();
                if ($inputArray == $expectedArray) {
                    return true;
                }

                return false;
            }));

        if ($shouldHappen) {
            $prophecy->shouldBeCalled();
        } else {
            $prophecy->shouldNotBeCalled();
        }
    }

    private function prepareInternationalToE164Prophecy()
    {
        $internationalToE164 = new TransformationRuleDto();
        $internationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerin')
            ->setDescription("From international to e164")
            ->setPriority(1)
            ->setMatchExpr('^(\+|00)([0-9]+)$')
            ->setReplaceExpr('+\2');

        $this->setExpectedOutcome($internationalToE164);
    }

    private function prepareOutOfAreaNationalToE164Prophecy($trunkPrefix, $shouldHappen = true)
    {
        $nationalToE164 = new TransformationRuleDto();
        $nationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerin')
            ->setDescription("From out of area national to e164")
            ->setPriority(2)
            ->setMatchExpr('^' . $trunkPrefix . '([0-9]{9})$')
            ->setReplaceExpr('34\1');

        $this->setExpectedOutcome($nationalToE164, $shouldHappen);
    }

    private function prepareWithinNationalToE164Prophecy($nationalLen, $areaCode, $shouldHappen = true)
    {
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        $nationalToE164 = new TransformationRuleDto();
        $nationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerin')
            ->setDescription("From within area national to e164")
            ->setPriority(3)
            ->setMatchExpr('^([0-9]{' . $nationalSubscriberLen . '})$')
            ->setReplaceExpr('34' . $areaCode . '\1');

        $this->setExpectedOutcome($nationalToE164, $shouldHappen);
    }

    private function prepareNationalToE164Prophecy()
    {
        $nationalToE164 = new TransformationRuleDto();
        $nationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerin')
            ->setDescription("From national to e164")
            ->setPriority(5)
            ->setMatchExpr('^([0-9]+)$')
            ->setReplaceExpr('34\1');

        $this->setExpectedOutcome($nationalToE164);
    }
}
