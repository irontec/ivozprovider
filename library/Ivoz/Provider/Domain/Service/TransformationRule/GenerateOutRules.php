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
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public function execute(TransformationRuleSetInterface $entity, $type)
    {
        // Get RuleSet data
        $internationalCode = $entity->getInternationalCode();
        $countryCode = $entity->getCountry()->getCountryCode();
        $trunkPrefix = $entity->getTrunkPrefix();
        $areaCode = $entity->getAreaCode();
        $nationalLen = $entity->getNationalLen();
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        if (!empty($areaCode)) {
            $ruleDTO = new TransformationRuleDto();
            $ruleDTO
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From e164 to within area national")
                ->setPriority(1)
                ->setMatchExpr('^\\' . $countryCode . $areaCode . '([0-9]{' . $nationalSubscriberLen . '})$')
                ->setReplaceExpr('\1');

            $this->entityPersister->persistDto($ruleDTO);
        }

        if (!empty($trunkPrefix)) {
            $ruleDTO = new TransformationRuleDto();
            $ruleDTO
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From e164 to out of area national")
                ->setPriority(2)
                ->setMatchExpr('^\\' . $countryCode . '([0-9]{' . $nationalLen . '})$')
                ->setReplaceExpr('\1');

            $this->entityPersister->persistDto($ruleDTO);
        }

        $ruleDTO = new TransformationRuleDto();
        $ruleDTO
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From e164 to special national")
            ->setPriority(3)
            ->setMatchExpr('^\\' . $countryCode . '([0-9]+)$')
            ->setReplaceExpr('\1');

        $this->entityPersister->persistDto($ruleDTO);

        $ruleDTO = new TransformationRuleDto();
        $ruleDTO
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From e164 to international")
            ->setPriority(4)
            ->setMatchExpr('^\\+([0-9]+)$')
            ->setReplaceExpr($internationalCode . '\1');

        $this->entityPersister->persistDto($ruleDTO);
    }

}