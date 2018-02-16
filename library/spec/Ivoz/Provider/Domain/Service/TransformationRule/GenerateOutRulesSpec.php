<?php

namespace spec\Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateoutRules;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenerateOutRulesSpec extends ObjectBehavior
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

    function it_is_initializable() {
        $this->shouldHaveType(GenerateOutRules::class);
    }

    function it_doesnt_create_e164ToWithinNational_rule_if_areaCode_is_empty(
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

        $this->prepare164ToWithinNationalProphecy($nationalLen, $areaCode, false);

        $this->execute($entity, 'callerout');
    }

    function it_creates_e164TowithinNational_rule_if_areaCode_is_not_empty(
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

        $this->prepare164ToWithinNationalProphecy($nationalLen, $areaCode);

        $this->execute($entity, 'callerout');
    }

    function it_doesnt_create_e164ToOutOfAreaNational_rule_if_trunkPrefix_is_empty(
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

        $this->prepare164ToOutOfAreaNationalProphecy($trunkPrefix, false);

        $this->execute($entity, 'callerout');
    }

    function it_creates_e164ToOutOfAreaNational_rule_if_trunkPrefix_is_not_empty(
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

        $this->prepare164ToOutOfAreaNationalProphecy($trunkPrefix, false);

        $this->execute($entity, 'callerout');
    }

    function it_creates_e164ToSpecialNational_rule(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepare164ToSpecialNationalProphecy();

        $this->execute($entity, 'callerout');
    }

    function it_creates_e164ToInternational_rule(
        TransformationRuleSetInterface $entity,
        CountryInterface $country
    ) {
        $this->prepareEntityBehaviour($entity, $country);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->willReturn(null);

        $this->prepare164ToInternationalProphecy();

        $this->execute($entity, 'callerout');
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

    private function prepare164ToWithinNationalProphecy($nationalLen, $areaCode, $shouldHappen = true)
    {
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        $nationalToE164 = new TransformationRuleDto();
        $nationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerout')
            ->setDescription("From e164 to within area national")
            ->setPriority(1)
            ->setMatchExpr('^\\34' . $areaCode . '([0-9]{' . $nationalSubscriberLen . '})$')
            ->setReplaceExpr('\1');

        $this->setExpectedOutcome($nationalToE164, $shouldHappen);
    }

    private function prepare164ToOutOfAreaNationalProphecy($shouldHappen = true)
    {
        $nationalToE164 = new TransformationRuleDto();
        $nationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerout')
            ->setDescription("From e164 to out of area national")
            ->setPriority(2)
            ->setMatchExpr('^\\34([0-9]{9})$')
            ->setReplaceExpr('34\1');

        $this->setExpectedOutcome($nationalToE164, $shouldHappen);
    }

    private function prepare164ToSpecialNationalProphecy()
    {
        $nationalToE164 = new TransformationRuleDto();
        $nationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerout')
            ->setDescription("From e164 to special national")
            ->setPriority(3)
            ->setMatchExpr('^\\34([0-9]+)$')
            ->setReplaceExpr('\1');

        $this->setExpectedOutcome($nationalToE164);
    }

    private function prepare164ToInternationalProphecy()
    {
        $internationalToE164 = new TransformationRuleDto();
        $internationalToE164
            ->setTransformationRuleSetId(1)
            ->setType('callerout')
            ->setDescription("From e164 to international")
            ->setPriority(4)
            ->setMatchExpr('^\\+([0-9]+)$')
            ->setReplaceExpr('00\1');

        $this->setExpectedOutcome($internationalToE164);
    }
}
