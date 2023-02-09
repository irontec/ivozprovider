<?php

namespace Ivoz\Cgr\Domain\Service\TpDerivedCharger;

use Ivoz\Cgr\Domain\Model\TpDerivedCharger\TpDerivedCharger;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

class CreatedByBrand implements BrandLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(BrandInterface $brand): void
    {
        $isNew = $brand->isNew();
        if (!$isNew) {
            return;
        }

        // Create a new TpDerivedCharger when brand is created
        $tpDerivedChargeDto = TpDerivedCharger::createDto();
        $tpDerivedChargeDto
            ->setTpid($brand->getCgrTenant())
            ->setTenant($brand->getCgrTenant())
            ->setBrandId($brand->getId());

        $this->entityTools->persistDto($tpDerivedChargeDto, null);
    }
}
