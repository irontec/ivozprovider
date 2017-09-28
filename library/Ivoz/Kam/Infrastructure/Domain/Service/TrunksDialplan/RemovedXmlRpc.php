<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksDialplan;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;

/**
 * Class RemovedXmlRpc
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(TrunksDialplanInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Kam Trunks may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}