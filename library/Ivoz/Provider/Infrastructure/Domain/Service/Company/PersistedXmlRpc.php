<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Company;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * Class PersistedSendXmlRcp
 * @package Ivoz\Provider\Domain\Service\Company
 * @lifecycle post_persist
 */
class PersistedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(CompanyInterface $entity, $isNew)
    {
        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Company may have been saved.</p>';
            throw new \Exception($message);
        }
    }
}