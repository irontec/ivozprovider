<?php
namespace Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk;

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
        $transformationRulesetGroupsTrunksId = $entity
            ->getTransformationRulesetGroupsTrunk()
            ->getId();

        $criteria = [
            'dpid' => $dpid,
            'transformationRulesetGroupsTrunk' => $transformationRulesetGroupsTrunksId
        ];

        $nRemaining = $this
            ->trunksDialplanRepository
            ->countByCriteria($criteria);

        if ($nRemaining != 0) {
            return;
        }

        $transformationRulesetGroupsTrunk = $entity->getTransformationRulesetGroupsTrunk();
        $targetFields = [
            'callerIn',
            'callerOut',
            'calleeIn',
            'calleeOut'
        ];

        foreach ($targetFields as $field) {
            $getter = 'get' . ucfirst($field);
            $setter = 'set' . ucfirst($field);

            if ($transformationRulesetGroupsTrunk->{$getter}() == $dpid) {
                $transformationRulesetGroupsTrunk->{$setter}(null);
            }
        }
    }
}