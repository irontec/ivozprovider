<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\UsersAddress;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;

/**
 * Class RemovedXmlRpc
 * @package Ivoz\Kam\Domain\Service\UsersAddres
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(UsersAddressInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Authorized source may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}