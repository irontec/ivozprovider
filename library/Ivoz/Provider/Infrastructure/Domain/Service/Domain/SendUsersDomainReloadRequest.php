<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Domain;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

class SendUsersDomainReloadRequest implements DomainLifecycleEventHandlerInterface
{
    protected $usersDomainReload;

    public function __construct(
        XmlRpcUsersRequest $usersDomainReload
    ) {
        $this->usersDomainReload = $usersDomainReload;
    }

    public function execute(DomainInterface $entity)
    {
        $this->usersDomainReload->send();
    }
}