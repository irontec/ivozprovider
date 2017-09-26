<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksUacreg;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

/**
 * Class PersistedXmlRpc
 * @package Ivoz\Kam\Domain\Service\TrunksUacreg
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(TrunksUacregInterface $entity, $isNew)
    {

        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Sip registy may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}