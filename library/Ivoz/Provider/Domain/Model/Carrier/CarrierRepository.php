<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CarrierRepository extends ObjectRepository, Selectable
{
    /**
     * @return array
     */
    public function getCarrierIdsGroupByBrand();
}
