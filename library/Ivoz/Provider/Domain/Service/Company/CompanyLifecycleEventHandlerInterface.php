<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface CompanyLifecycleEventHandlerInterface
{
    public function execute(CompanyInterface $entity, $isNew);
}