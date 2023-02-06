<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface AdministratorLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(AdministratorInterface $administrator);
}
