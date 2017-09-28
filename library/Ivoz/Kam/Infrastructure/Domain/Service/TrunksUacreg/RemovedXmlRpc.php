<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksUacreg;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

/**
 * Class RemovedXmlRpc
 * @package Ivoz\Kam\Domain\Service\TrunksUacreg
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(TrunksUacregInterface $entity, $isNew)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Sip registy may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}