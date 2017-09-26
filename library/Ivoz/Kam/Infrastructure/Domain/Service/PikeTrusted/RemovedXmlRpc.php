<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\PikeTrusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;

/**
 * Class RemovedXmlRpc
 * @package Ivoz\Kam\Domain\Service\PikeTrusted
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(PikeTrustedInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Trusted source may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}