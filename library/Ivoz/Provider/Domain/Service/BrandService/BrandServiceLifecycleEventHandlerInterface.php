<?php

namespace Ivoz\Provider\Domain\Service\BrandService;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;

interface BrandServiceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(BrandServiceInterface $entity);
}
