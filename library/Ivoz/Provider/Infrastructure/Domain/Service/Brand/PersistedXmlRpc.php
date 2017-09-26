<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Brand;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\Brand
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(BrandInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Brand may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}