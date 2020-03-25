<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

interface DdiProviderRepository extends ObjectRepository, Selectable
{

    public function getDdiProviderIdsByBrandAdmin(AdministratorInterface $admin): array;

    /**
     * @param BrandInterface $brand
     * @param ProxyTrunkInterface $proxyTrunks
     * @return mixed
     */
    public function findByBrandAndProxyTrunks(BrandInterface $brand, ProxyTrunkInterface $proxyTrunks);

    /**
     * @param ProxyTrunkInterface $proxyTrunks
     * @return mixed
     */
    public function findByProxyTrunks(ProxyTrunkInterface $proxyTrunks);
}
