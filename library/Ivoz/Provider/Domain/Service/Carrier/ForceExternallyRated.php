<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Feature\Feature;

/**
 * Class ForceExternallyRated
 * @package Ivoz\Provider\Domain\Service\Carrier
 * @lifecycle pre_persist
 */
class ForceExternallyRated implements CarrierLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * Enables externally rated on carrier when Brand has no Billing feature enabled
     *
     * @param CarrierInterface $carrier
     */
    public function execute(CarrierInterface $carrier)
    {
        // Only apply to carriers with externally rated disabled
        if ($carrier->getExternallyRated()) {
            return;
        }

        $brand = $carrier->getBrand();

        // Check if brand has billing feature enabled
        if (!$brand->hasFeature(Feature::BILLING)) {
            /** @var CarrierDto $carrierDto */
            $carrierDto = $this->entityTools->entityToDto(
                $carrier
            );

            // Force externally rated on carrier
            $carrierDto->setExternallyRated(true);

            $this->entityTools->updateEntityByDto(
                $carrier,
                $carrierDto
            );
        }
    }
}
