<?php

namespace Ivoz\Cgr\Domain\Service\TpDerivedCharger;

use Ivoz\Cgr\Domain\Model\TpDerivedCharger\TpDerivedCharger;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

class CreatedByBrand implements BrandLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreatedByBrand constructor.
     *
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
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

    /**
     *
     * @param BrandInterface $brand
     * @param $isNew
     */
    public function execute(BrandInterface $brand)
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
