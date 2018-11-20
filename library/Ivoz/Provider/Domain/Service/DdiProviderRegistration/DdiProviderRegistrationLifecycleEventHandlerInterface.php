<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderRegistration;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;

interface DdiProviderRegistrationLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DdiProviderRegistrationInterface $entity);
}
