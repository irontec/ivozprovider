<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\PikeTrusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;

/**
 * Class PersistedXmlRpc
 * @package Ivoz\Kam\Infrastructure\Domain\Service\PikeTrusted
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(PikeTrustedInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Trusted source may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}