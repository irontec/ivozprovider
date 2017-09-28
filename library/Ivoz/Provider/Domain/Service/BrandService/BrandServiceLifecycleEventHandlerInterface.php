<?php

namespace Ivoz\Provider\Domain\Service\BrandService;

use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;

interface BrandServiceLifecycleEventHandlerInterface
{
    public function execute(BrandServiceInterface $entity, $isNew);
}