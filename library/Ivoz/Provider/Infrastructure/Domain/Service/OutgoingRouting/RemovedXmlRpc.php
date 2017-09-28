<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\OutgoingRouting\Service\OutgoingRouting
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(OutgoingRoutingInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>LCR Gateways may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}