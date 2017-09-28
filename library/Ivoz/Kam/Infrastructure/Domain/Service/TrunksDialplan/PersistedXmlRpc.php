<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksDialplan;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;

/**
 * Class PersistedXmlRpc
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(TrunksDialplanInterface $entity)
    {

        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Kam Trunks may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}