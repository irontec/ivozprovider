<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface CarrierRepository extends ObjectRepository, Selectable
{
    /**
     * @return array
     */
    public function getCarrierIdsGroupByBrand();

    public function getCarrierIdsByBrandAdmin(AdministratorInterface $admin): array;
}
