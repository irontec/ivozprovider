<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

class SendUsersDomainReloadRequest implements DomainLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private UsersClientInterface $usersClient
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(DomainInterface $entity)
    {
        $this->usersClient->reloadDomain();
    }
}
