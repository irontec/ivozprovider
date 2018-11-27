<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CarrierRepository extends ObjectRepository, Selectable
{
    /**
     * @return array
     */
    public function getCarrierIdsGroupByBrand();
}
