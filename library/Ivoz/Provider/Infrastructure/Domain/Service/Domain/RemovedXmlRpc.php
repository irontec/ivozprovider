<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Domain;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\Domain
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(DomainInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Domain may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}