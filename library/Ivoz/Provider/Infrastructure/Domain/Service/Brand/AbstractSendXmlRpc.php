<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Brand;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReload;
use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersDomainReload;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements BrandLifecycleEventHandlerInterface
{
    protected $lcrReload;
    protected $domainReload;

    public function __construct(
        RequestProxyTrunksLcrReload $lcrReload,
        RequestProxyUsersDomainReload $domainReload
    ) {
        $this->lcrReload = $lcrReload;
        $this->domainReload = $domainReload;
    }

    public function execute(BrandInterface $entity, $isNew)
    {
        $this->lcrReload->send();
        $this->domainReload->send();
    }
}