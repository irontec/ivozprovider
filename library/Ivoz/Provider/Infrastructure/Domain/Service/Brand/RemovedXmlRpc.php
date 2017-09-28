<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Brand;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\Brand
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(BrandInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Brand may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}