<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPattern;

use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\RoutingPattern\Service\RoutingPattern
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(RoutingPatternInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Routing pattern may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}