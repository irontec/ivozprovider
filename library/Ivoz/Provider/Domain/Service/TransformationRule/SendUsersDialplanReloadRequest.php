<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

class SendUsersDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_HIGH;

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
    public function execute(TransformationRuleInterface $transformationRule)
    {
        $this->usersClient->reloadDialplan();
    }
}
