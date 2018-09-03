<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class CreateByCarrier implements CarrierLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreateByCarrier constructor.
     *
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(CarrierInterface $carrier, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var CarrierDto $carrierDto */
        $carrierDto = $this->entityTools->entityToDto($carrier);

        // Create a new TpAccountAction when Carrier is created
        $accountActionDto = TpAccountAction::createDTO();
        $accountActionDto
            ->setCarrierId($carrierDto->getId())
            ->setTenant(sprintf("b%d", $carrierDto->getBrandId()))
            ->setAccount(sprintf("cr%d", $carrierDto->getId()));

        $this->entityTools->persistDto($accountActionDto, null);
    }
}
