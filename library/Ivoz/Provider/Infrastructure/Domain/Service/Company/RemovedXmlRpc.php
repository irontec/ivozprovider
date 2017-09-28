<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Company;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\Company
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(CompanyInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Company may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}