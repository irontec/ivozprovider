<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements FeaturesRelBrandLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param FeaturesRelBrandInterface $relBrand
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(FeaturesRelBrandInterface $relBrand)
    {
        $this->assertUnchanged($relBrand);
    }
}
