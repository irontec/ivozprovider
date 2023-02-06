<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelCompany;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;

interface FeaturesRelCompanyLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(FeaturesRelCompanyInterface $relCompany);
}
