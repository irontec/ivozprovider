<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

class SendUsersDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_HIGH;

    protected $usersClient;

    public function __construct(
        UsersClientInterface $usersClient
    ) {
        $this->usersClient = $usersClient;
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
    public function execute(TransformationRuleInterface $entity)
    {
        $this->usersClient->reloadDialplan();
    }
}
