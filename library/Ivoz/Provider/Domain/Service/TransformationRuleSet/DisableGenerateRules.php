<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

class DisableGenerateRules
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @return void
     */
    public function execute(
        TransformationRuleSetInterface $transformationRuleSet,
        $dispatchImmediately = false
    ) {
        // Mark rules as generated
        /** @var TransformationRuleSetDto $transformationRuleSetDto */
        $transformationRuleSetDto = $this->entityTools->entityToDto($transformationRuleSet);

        $transformationRuleSetDto->setGenerateRules(false);
        $this->entityTools->persistDto(
            $transformationRuleSetDto,
            $transformationRuleSet,
            $dispatchImmediately
        );
    }
}
