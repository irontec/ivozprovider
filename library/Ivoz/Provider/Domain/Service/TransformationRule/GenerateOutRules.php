<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

/**
 * Class GenerateRules
 * @package Ivoz\Provider\Domain\Service\TransformationRule
 */
class GenerateOutRules
{
    public function __construct(
        private EntityPersisterInterface $entityPersister
    ) {
    }

    /**
     * @return void
     */
    public function execute(TransformationRuleSetInterface $transformationRuleSet, string $type)
    {
        // Get RuleSet data
        $internationalCode = $transformationRuleSet->getInternationalCode();
        $countryCode = $transformationRuleSet->getCountry()->getCountryCode();
        $trunkPrefix = $transformationRuleSet->getTrunkPrefix();
        $areaCode = $transformationRuleSet->getAreaCode();
        $nationalLen = $transformationRuleSet->getNationalLen();
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        if (!empty($areaCode)) {
            $ruleDto = new TransformationRuleDto();
            $ruleDto
                ->setTransformationRuleSetId($transformationRuleSet->getId())
                ->setType($type)
                ->setDescription("From e164 to within area national")
                ->setPriority(1)
                ->setMatchExpr('^\\' . $countryCode . $areaCode . '([0-9]{' . $nationalSubscriberLen . '})$')
                ->setReplaceExpr('\1');

            $this->entityPersister->persistDto($ruleDto);
        }

        if (!empty($trunkPrefix)) {
            $ruleDto = new TransformationRuleDto();
            $ruleDto
                ->setTransformationRuleSetId($transformationRuleSet->getId())
                ->setType($type)
                ->setDescription("From e164 to out of area national")
                ->setPriority(2)
                ->setMatchExpr('^\\' . $countryCode . '([0-9]{' . $nationalLen . '})$')
                ->setReplaceExpr('\1');

            $this->entityPersister->persistDto($ruleDto);
        }

        $ruleDto = new TransformationRuleDto();
        $ruleDto
            ->setTransformationRuleSetId($transformationRuleSet->getId())
            ->setType($type)
            ->setDescription("From e164 to special national")
            ->setPriority(3)
            ->setMatchExpr('^\\' . $countryCode . '([0-9]+)$')
            ->setReplaceExpr('\1');

        $this->entityPersister->persistDto($ruleDto);

        $ruleDto = new TransformationRuleDto();
        $ruleDto
            ->setTransformationRuleSetId($transformationRuleSet->getId())
            ->setType($type)
            ->setDescription("From e164 to international")
            ->setPriority(4)
            ->setMatchExpr('^\\+([0-9]+)$')
            ->setReplaceExpr($internationalCode . '\1');

        $this->entityPersister->persistDto($ruleDto);
    }
}
