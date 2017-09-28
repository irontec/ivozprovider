<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\ApplicationServer
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(ApplicationServerInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Application Server may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}