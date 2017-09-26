<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Domain;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersDomainReload;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements DomainLifecycleEventHandlerInterface
{
    protected $domainReload;

    public function __construct(
        RequestProxyUsersDomainReload $domainReload
    ) {
        $this->domainReload = $domainReload;
    }

    public function execute(DomainInterface $entity)
    {
        $this->domainReload->send();
    }
}