<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface ProxyTrunksRelBrandRepository extends ObjectRepository, Selectable
{
    /**
     * @param AdministratorInterface $admin
     * @return int[]
     */
    public function getTrunkIdsByBrandAdmin(AdministratorInterface $admin): array;
}
