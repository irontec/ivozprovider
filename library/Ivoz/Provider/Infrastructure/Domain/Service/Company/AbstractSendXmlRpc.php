<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Company;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReload;
use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersDomainReload;
use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersPermissionsAddressReload;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements CompanyLifecycleEventHandlerInterface
{
    protected $lcrReload;
    protected $domainReload;
    protected $addressReload;

    public function __construct(
        RequestProxyTrunksLcrReload $lcrReload,
        RequestProxyUsersDomainReload $domainReload,
        RequestProxyUsersPermissionsAddressReload $addressReload
    ) {
        $this->lcrReload = $lcrReload;
        $this->domainReload = $domainReload;
        $this->addressReload = $addressReload;
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        $this->lcrReload->send();
        $this->domainReload->send();
        $this->addressReload->send();
    }
}