<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;

class AvoidRemovingInUseAddresses implements ProxyTrunksRelBrandLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private CarrierRepository $carrierRepository,
        private DdiProviderRepository $ddiProviderRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::PRIORITY_NORMAL,
        ];
    }
    /**
     * @param ProxyTrunksRelBrandInterface $relBrand
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ProxyTrunksRelBrandInterface $relBrand)
    {
        $brand = $relBrand->getBrand();
        $isBrandBeingRemoved = $this->entityTools->isScheduledForRemoval(
            $brand
        );
        if ($isBrandBeingRemoved) {
            return;
        }

        $proxyTrunks = $relBrand->getProxyTrunk();

        $carriers = $this->carrierRepository->findByBrandAndProxyTrunks($brand, $proxyTrunks);
        $ddiProviders = $this->ddiProviderRepository->findByBrandAndProxyTrunks($brand, $proxyTrunks);

        if ($carriers || $ddiProviders) {
            throw new \DomainException("Cannot unassign proxyTrunks IP as it is in use in at least one carrier or ddiProvider");
        }
    }
}
