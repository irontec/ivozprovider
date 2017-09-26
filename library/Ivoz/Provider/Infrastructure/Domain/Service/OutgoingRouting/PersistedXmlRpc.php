<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\OutgoingRouting\Service\OutgoingRouting
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(OutgoingRoutingInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>LCR Gateways may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}