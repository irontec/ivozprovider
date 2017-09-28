<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPatternGroup;

use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\RoutingPatternGroup\Service\RoutingPatternGroup
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(RoutingPatternGroupInterface $entity, $isNew)
    {
        $outgoingRoutings = $entity->getOutgoingRoutings();
        if (empty($outgoingRoutings)) {
            return;
        }

        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Routing pattern group may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}