<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class UpdateUserEndpoint
 * @todo trigger this automatically within the entity
 * @package Ivoz\Provider\Domain\Service\User
 * @lifecycle pre_persist
 */
class UpdateUserEndpoint implements UserLifecycleEventHandlerInterface
{

    public function __construct() {}

    public function execute(UserInterface $entity, $isNew)
    {
        $entity->updateEndpoint();
    }
}