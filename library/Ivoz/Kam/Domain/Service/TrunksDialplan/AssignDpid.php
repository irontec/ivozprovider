<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplan;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanRepository;
use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;
use Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface;

/**
 * Class AssignDpid
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle pre_persist
 */
class AssignDpid implements TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface
{
    use CreateDialplanRuleDtoTrait;

    /**
     * @var TrunksDialplanRepository
     */
    protected $trunksDialplanRepository;

    public function __construct(
        TrunksDialplanRepository $trunksDialplanRepository
    ) {
        $this->trunksDialplanRepository = $trunksDialplanRepository;
    }

    public function execute(TransformationRulesetGroupsTrunkInterface $entity, $isNew)
    {
        if (!$isNew || !$entity->getAutomatic()) {
            return;
        }

        /**
         * @var TrunksDialplan[] $maxDpiTrunksDialplans
         */
        $maxDpiTrunksDialplans = $this->trunksDialplanRepository->findBy(
            [],
            ['dpid' => 'DESC'],
            1
        );

        $dpid = 1;
        if (!empty($maxDpiTrunksDialplans)) {
            $maxDpiTrunksDialplan = $maxDpiTrunksDialplans[0];
            $dpid = $maxDpiTrunksDialplan->getDpid() + 1;
        }

        $entity->setCalleeOut($dpid);
        $entity->setCallerOut(++$dpid);
        $entity->setCalleeIn(++$dpid);
        $entity->setCallerIn(++$dpid);
    }
}