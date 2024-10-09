<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSetsRelBrand;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandInterface;

interface ApplicationServerSetsRelBrandLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ApplicationServerSetsRelBrandInterface $applicationServerSetsRelBrand): void;
}
