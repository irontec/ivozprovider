<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRule;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequestInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\TransformationRuleLifecycleEventHandlerInterface;

class SendUsersDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
{
    protected $usersDialplanReload;

    public function __construct(
        XmlRpcUsersRequestInterface $usersDialplanReload
    ) {
        $this->usersDialplanReload = $usersDialplanReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(TransformationRuleInterface $entity)
    {
        $this->usersDialplanReload->send();
    }
}
