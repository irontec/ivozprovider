<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanDTO;

trait CreateDialplanRuleDtoTrait
{
    /**
     * @param TransformationRulesetGroupsTrunkInterface $entity
     * @param $matchExp
     * @param $replaceExp
     * @param $prio
     * @param $desc
     * @param null $dpid
     * @return TrunksDialplanDTO
     */
    public function createDialplanRuleDtoByTransformationRulesetGroupsTrunk(
        TransformationRulesetGroupsTrunkInterface $entity,
        $matchExp,
        $replaceExp,
        $prio,
        $desc,
        $dpid = null
    ) {
        $trunksDialplanDTO = new TrunksDialplanDTO();

        $trunksDialplanDTO
            ->setDpid($dpid)
            ->setPr($prio)
            ->setMatchOp(1)
            ->setMatchExp($matchExp)
            ->setMatchLen(0)
            ->setSubstExp($matchExp)
            ->setReplExp($replaceExp)
            ->setAttrs($desc)
            ->setTransformationRulesetGroupsTrunkId($entity->getId());

        return $trunksDialplanDTO;
    }
}