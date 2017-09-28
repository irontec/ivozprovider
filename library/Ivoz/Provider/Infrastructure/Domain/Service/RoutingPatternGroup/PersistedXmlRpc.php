<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPatternGroup;

use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

/**
 * Class PersistedXmlRpc
 * @package Ivoz\Provider\Infrastructure\RoutingPatternGroup\Service\RoutingPatternGroup
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(RoutingPatternGroupInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Routing pattern group may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}