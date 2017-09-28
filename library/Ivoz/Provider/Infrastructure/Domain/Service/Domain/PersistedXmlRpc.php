<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Domain;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\Domain
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(DomainInterface $entity)
    {
        try {
            parent::execute($entity);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Domain may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}