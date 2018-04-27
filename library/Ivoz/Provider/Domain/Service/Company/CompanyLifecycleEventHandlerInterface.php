<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface CompanyLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CompanyInterface $entity, $isNew);
}