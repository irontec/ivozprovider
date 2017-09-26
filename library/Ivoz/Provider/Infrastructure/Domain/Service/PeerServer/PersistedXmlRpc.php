<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\PeerServer\Service\PeerServer
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(PeerServerInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>LCR Gateways may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}