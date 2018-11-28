<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequestInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

class SendUsersDialplanReloadRequest implements TransformationRuleSetLifecycleEventHandlerInterface
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

    public function execute(TransformationRuleSetInterface $transformationRuleSet)
    {
        $this->usersDialplanReload->send();
    }
}
