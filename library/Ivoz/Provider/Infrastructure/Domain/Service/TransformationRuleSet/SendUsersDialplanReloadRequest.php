<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

class SendUsersDialplanReloadRequest implements TransformationRuleSetLifecycleEventHandlerInterface
{
    protected $usersDialplanReload;

    public function __construct(
        XmlRpcUsersRequest $usersDialplanReload
    ) {
        $this->usersDialplanReload = $usersDialplanReload;
    }

    public function execute(TransformationRuleSetInterface $entity, $isNew)
    {
        $this->usersDialplanReload->send();
    }
}