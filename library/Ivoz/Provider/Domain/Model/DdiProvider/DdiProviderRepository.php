<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

interface DdiProviderRepository extends ObjectRepository, Selectable
{
    /**
     * @return array<array-key, int>
     */
    public function getDdiProviderIdsByBrandAdmin(AdministratorInterface $admin): array;

    /**
     * @param BrandInterface $brand
     * @param ProxyTrunkInterface $proxyTrunks
     * @return mixed
     */
    public function findByBrandAndProxyTrunks(BrandInterface $brand, ProxyTrunkInterface $proxyTrunks);

    /**
     * @return DdiProviderInterface[]
     */
    public function findByProxyTrunks(ProxyTrunkInterface $proxyTrunks): array;

    /**
     * @param int $brandId | null
     * @return string[]
     */
    public function getNames($brandId = null);

    /**
     * @return DdiProviderInterface | null
     */
    public function findOneByBrandAndName(int $brandId, string $name);

    /**
     * @return DdiProviderInterface[]
     */
    public function findByMediaRelaySetIdAndBrandId(int $mediaRelaySetId, int $brandId): array;
}
