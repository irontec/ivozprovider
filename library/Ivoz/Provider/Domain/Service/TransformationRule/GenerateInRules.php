<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

class GenerateInRules
{
    public function __construct(
        private EntityPersisterInterface $entityPersister
    ) {
    }

    /**
     * @return void
     */
    public function execute(TransformationRuleSetInterface $entity, $type)
    {
        // Get RuleSet data
        $internationalCode = $entity->getInternationalCode();
        $countryCode = $entity->getCountry()->getCountryCode();
        $trunkPrefix = $entity->getTrunkPrefix();
        $areaCode = $entity->getAreaCode();
        $nationalLen = $entity->getNationalLen();
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        $ruleDto = new TransformationRuleDto();
        $ruleDto
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From international to e164")
            ->setPriority(1)
            ->setMatchExpr('^(\+|' . $internationalCode . ')([0-9]+)$')
            ->setReplaceExpr('+\2');

        $this->entityPersister->persistDto($ruleDto);

        if (strlen($trunkPrefix) > 0) {
            $ruleDto = new TransformationRuleDto();
            $ruleDto
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From out of area national to e164")
                ->setPriority(2)
                ->setMatchExpr('^' . $trunkPrefix . '([0-9]{' . $nationalLen . '})$')
                ->setReplaceExpr($countryCode . '\1');

            $this->entityPersister->persistDto($ruleDto);
        }

        if (strlen($areaCode) > 0) {
            $ruleDto = new TransformationRuleDto();
            $ruleDto
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From within area national to e164")
                ->setPriority(3)
                ->setMatchExpr('^([0-9]{' . $nationalSubscriberLen . '})$')
                ->setReplaceExpr($countryCode . $areaCode . '\1');

            $this->entityPersister->persistDto($ruleDto);
        }

        $ruleDto = new TransformationRuleDto();
        $ruleDto
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From national to e164")
            ->setPriority(5)
            ->setMatchExpr("^([0-9]+)$")
            ->setReplaceExpr($countryCode . '\1');

        $this->entityPersister->persistDto($ruleDto);
    }
}
