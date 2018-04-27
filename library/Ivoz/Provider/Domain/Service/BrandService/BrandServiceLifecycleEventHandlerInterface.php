<?php

namespace Ivoz\Provider\Domain\Service\BrandService;

use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface BrandServiceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(BrandServiceInterface $entity, $isNew);
}