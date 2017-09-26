<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRulesetGroupsTrunk;

use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\TransformationRulesetGroupsTrunk\Service\TransformationRulesetGroupsTrunk
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(TransformationRulesetGroupsTrunkInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Transformation ruleset groups trunks may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}