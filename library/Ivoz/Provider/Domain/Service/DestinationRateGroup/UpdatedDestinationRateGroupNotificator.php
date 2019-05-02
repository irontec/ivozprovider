<?php

namespace Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class UpdatedDestinationRateGroupNotificator extends CgratesReloadNotificator implements DestinationRateGroupLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param DestinationRateGroupInterface $destinationRateGroup
     *
     * @return void
     */
    public function execute(DestinationRateGroupInterface $destinationRateGroup)
    {
        // When a destination rate group has been deleted
        if (is_null($destinationRateGroup->getId())) {
            $brand = $destinationRateGroup->getBrand();
            $this->reload($brand->getCgrTenant());
        }
    }
}
