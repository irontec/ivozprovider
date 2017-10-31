<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDTO;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

/**
 * Class GenerateRules
 * @package Ivoz\Provider\Domain\Service\TransformationRule;
 * @lifecycle post_persist
 */
class GenerateRules implements TransformationRuleSetLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;


    public function __construct(
        EntityPersisterInterface $entityPersister
    )
    {
        $this->entityPersister = $entityPersister;
    }

    public function execute(TransformationRuleSetInterface $entity, $isNew)
    {
        // Only if requested to autogenerate rules
        if (!$entity->getGenerateRules()) {
            return;
        }

        // Delete existing Rules for given ruleset
        /** @var TransformationRuleInterface[] $rules */
        $rules = $entity->getRules();
        foreach ($rules as $rule) {

            $entity
                ->removeRule($rule);

            $this->entityPersister
                ->remove($rule);
        }

        // Generate rules
        $this->generateInRules($entity, 'callerin');
        $this->generateInRules($entity, 'calleein');
        $this->generateOutRules($entity, 'callerout');
        $this->generateOutRules($entity, 'calleeout');

        // Mark rules as generated
        $entity->setGenerateRules(false);
        $this->entityPersister->persist($entity);
    }

    private function generateInRules(TransformationRuleSetInterface $entity, $type)
    {
        // Get RuleSet data
        $internationalCode = $entity->getInternationalCode();
        $countryCode = $entity->getCountry()->getCountryCode();
        $trunkPrefix = $entity->getTrunkPrefix();
        $areaCode = $entity->getAreaCode();
        $nationalLen = $entity->getNationalLen();
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        $ruleDTO = new TransformationRuleDTO();
        $ruleDTO
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From international to e164")
            ->setPriority(1)
            ->setMatchExpr('^(\+|' . $internationalCode . ')([0-9]+)$')
            ->setReplaceExpr('+\2');

        $this->entityPersister->persistDto($ruleDTO);

        if (!empty($trunkPrefix)) {
            $ruleDTO = new TransformationRuleDTO();
            $ruleDTO
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From out of area national to e164")
                ->setPriority(2)
                ->setMatchExpr('^' . $trunkPrefix . '([0-9]{' . $nationalLen . '})$')
                ->setReplaceExpr($countryCode . '\1');

            $this->entityPersister->persistDto($ruleDTO);
        }

        if (!empty($areaCode)) {
            $ruleDTO = new TransformationRuleDTO();
            $ruleDTO
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From within national to e164")
                ->setPriority(3)
                ->setMatchExpr('^([0-9]{' . $nationalSubscriberLen . '})$')
                ->setReplaceExpr($countryCode . $areaCode . '\1');

            $this->entityPersister->persistDto($ruleDTO);
        }

        $ruleDTO = new TransformationRuleDTO();
        $ruleDTO
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From special national to e164")
            ->setPriority(4)
            ->setMatchExpr("^([0-9]+)$")
            ->setReplaceExpr($countryCode . '\1');

        $this->entityPersister->persistDto($ruleDTO);
    }

    private function generateOutRules(TransformationRuleSetInterface $entity, $type)
    {

        // Get RuleSet data
        $internationalCode = $entity->getInternationalCode();
        $countryCode = $entity->getCountry()->getCountryCode();
        $trunkPrefix = $entity->getTrunkPrefix();
        $areaCode = $entity->getAreaCode();
        $nationalLen = $entity->getNationalLen();
        $nationalSubscriberLen = $nationalLen - strlen($areaCode);

        if (!empty($areaCode)) {
            $ruleDTO = new TransformationRuleDTO();
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
            $ruleDTO = new TransformationRuleDTO();
            $ruleDTO
                ->setTransformationRuleSetId($entity->getId())
                ->setType($type)
                ->setDescription("From e164 to out of area national")
                ->setPriority(2)
                ->setMatchExpr('^\\' . $countryCode . '([0-9]{' . $nationalLen . '})$')
                ->setReplaceExpr('\1');

            $this->entityPersister->persistDto($ruleDTO);
        }

        $ruleDTO = new TransformationRuleDTO();
        $ruleDTO
            ->setTransformationRuleSetId($entity->getId())
            ->setType($type)
            ->setDescription("From e164 to special national")
            ->setPriority(3)
            ->setMatchExpr('^\\' . $countryCode . '([0-9]+)$')
            ->setReplaceExpr('\1');

        $this->entityPersister->persistDto($ruleDTO);

        $ruleDTO = new TransformationRuleDTO();
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