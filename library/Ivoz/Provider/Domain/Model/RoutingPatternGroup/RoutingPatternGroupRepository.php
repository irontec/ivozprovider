<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RoutingPatternGroupRepository extends ObjectRepository, Selectable
{
    /**
     * @param $brandId
     * @param string $name
     * @return RoutingPatternGroupInterface
     */
    public function findByBrandIdAndName($brandId, string $name);
}
