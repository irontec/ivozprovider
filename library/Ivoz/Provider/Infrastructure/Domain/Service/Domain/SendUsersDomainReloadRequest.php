<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Domain;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequestInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

class SendUsersDomainReloadRequest implements DomainLifecycleEventHandlerInterface
{
    protected $usersDomainReload;

    public function __construct(
        XmlRpcUsersRequestInterface $usersDomainReload
    ) {
        $this->usersDomainReload = $usersDomainReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(DomainInterface $entity)
    {
        $this->usersDomainReload->send();
    }
}
