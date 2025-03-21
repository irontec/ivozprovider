<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class CreateByCarrier implements CarrierLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(CarrierInterface $carrier)
    {
        $isNew = $carrier->isNew();
        if (!$isNew) {
            return;
        }

        $brand = $carrier->getBrand();

        // Create a new TpAccountAction when Carrier is created
        $accountActionDto = TpAccountAction::createDTO();
        $accountActionDto
            ->setTpid($brand->getCgrTenant())
            ->setCarrierId($carrier->getId())
            ->setTenant($brand->getCgrTenant())
            ->setAllowNegative(true)
            ->setAccount($carrier->getCgrSubject());

        $this->entityTools->persistDto($accountActionDto, null);
    }
}
