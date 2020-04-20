<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;

class AvoidRemovingInUseAddresses implements ProxyTrunksRelBrandLifecycleEventHandlerInterface
{
    protected $entityTools;
    protected $carrierRepository;
    protected $ddiProviderRepository;

    public function __construct(
        EntityTools $entityTools,
        CarrierRepository $carrierRepository,
        DdiProviderRepository $ddiProviderRepository
    ) {
        $this->entityTools = $entityTools;
        $this->carrierRepository = $carrierRepository;
        $this->ddiProviderRepository = $ddiProviderRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE=> self::PRIORITY_NORMAL,
        ];
    }
    /**
     * @param ProxyTrunksRelBrandInterface $entity
     *
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(ProxyTrunksRelBrandInterface $entity)
    {
        $brand = $entity->getBrand();
        $isBrandBeingRemoved = $this->entityTools->isScheduledForRemoval(
            $brand
        );
        if ($isBrandBeingRemoved) {
            return;
        }

        $proxyTrunks = $entity->getProxyTrunk();

        $carriers = $this->carrierRepository->findByBrandAndProxyTrunks($brand, $proxyTrunks);
        $ddiProviders = $this->ddiProviderRepository->findByBrandAndProxyTrunks($brand, $proxyTrunks);

        if ($carriers || $ddiProviders) {
            throw new \DomainException("Cannot unassign proxyTrunks IP as it is in use in at least one carrier or ddiProvider");
        }
    }
}
