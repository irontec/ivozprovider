<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRule;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\TransformationRuleLifecycleEventHandlerInterface;

class SendUsersDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
{
    protected $usersDialplanReload;

    public function __construct(
        XmlRpcUsersRequest $usersDialplanReload
    ) {
        $this->usersDialplanReload = $usersDialplanReload;
    }

    public function execute(TransformationRuleInterface $entity, $isNew)
    {
        $this->usersDialplanReload->send();
    }
}