<?php
namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanRepository;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;
use Ivoz\Kam\Domain\Service\TrunksDialplan\TrunksDialplanLifecycleEventHandlerInterface;

class CleanUpByRemovedTrunksDialplan implements TrunksDialplanLifecycleEventHandlerInterface
{
    /**
     * @var TrunksDialplanRepository
     */
    protected $trunksDialplanRepository;

    public function __construct(
        TrunksDialplanRepository $trunksDialplanRepository
    ) {
        $this->trunksDialplanRepository = $trunksDialplanRepository;
    }

    public function execute(TrunksDialplanInterface $entity)
    {
        $dpid = $entity->getDpid();
        $TransformationRuleSetsId = $entity
            ->getTransformationRuleSet()
            ->getId();

        $criteria = [
            'dpid' => $dpid,
            'TransformationRuleSet' => $TransformationRuleSetsId
        ];

        $nRemaining = $this
            ->trunksDialplanRepository
            ->countByCriteria($criteria);

        if ($nRemaining != 0) {
            return;
        }

        $TransformationRuleSet = $entity->getTransformationRuleSet();
        $targetFields = [
            'callerIn',
            'callerOut',
            'calleeIn',
            'calleeOut'
        ];

        foreach ($targetFields as $field) {
            $getter = 'get' . ucfirst($field);
            $setter = 'set' . ucfirst($field);

            if ($TransformationRuleSet->{$getter}() == $dpid) {
                $TransformationRuleSet->{$setter}(null);
            }
        }
    }
}