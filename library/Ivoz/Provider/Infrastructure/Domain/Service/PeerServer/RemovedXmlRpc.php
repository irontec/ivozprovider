<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\PeerServer\Service\PeerServer
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(PeerServerInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>LCR Gateways may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}