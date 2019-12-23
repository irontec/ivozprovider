<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface RoutingPatternGroupRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $brandId
     * @param string $name
     * @return RoutingPatternGroupInterface
     */
    public function findByBrandIdAndName($brandId, string $name);
}
