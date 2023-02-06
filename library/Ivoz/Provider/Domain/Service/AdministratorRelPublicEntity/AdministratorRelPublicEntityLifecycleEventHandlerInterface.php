<?php

namespace Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;

interface AdministratorRelPublicEntityLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(AdministratorRelPublicEntityInterface $relPublicEntity);
}
