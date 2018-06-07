<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

interface RetailAccountLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RetailAccountInterface $entity, $isNew);
}