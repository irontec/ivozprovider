<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\UsersAddress;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;

/**
 * Class PersistedXmlRpc
 * @package Ivoz\Kam\Domain\Service\UsersAddres
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(UsersAddressInterface $entity)
    {

        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Authorized source may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}