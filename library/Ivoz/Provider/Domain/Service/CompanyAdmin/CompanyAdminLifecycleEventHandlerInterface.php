<?php

namespace Ivoz\Provider\Domain\Service\CompanyAdmin;

use Ivoz\Provider\Domain\Model\CompanyAdmin\CompanyAdminInterface;

interface CompanyAdminLifecycleEventHandlerInterface
{
    public function execute(CompanyAdminInterface $entity, $isNew);
}