<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\ApplicationServer
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(ApplicationServerInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Application Server may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}