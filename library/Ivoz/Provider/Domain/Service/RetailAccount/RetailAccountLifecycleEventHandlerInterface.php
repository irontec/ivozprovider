<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

interface RetailAccountLifecycleEventHandlerInterface
{
    public function execute(RetailAccountInterface $entity, $isNew);
}