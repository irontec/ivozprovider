<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface CompanyLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CompanyInterface $company): void;
}
