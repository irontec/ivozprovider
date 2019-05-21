<?php

namespace Ivoz\Cgr\Domain\Service\TpLcrRule;

use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRule;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

class CreatedByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreatedByOutgoingRouting constructor.
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

    /**
     * Create a new TpLcrRule when a Destination is created
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return void
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        if ($outgoingRouting->getRoutingMode() != OutgoingRoutingInterface::ROUTINGMODE_LCR) {
            return;
        }

        $brand = $outgoingRouting->getBrand();
        $tpLcrRule = $outgoingRouting->getTpLcrRule();

        /** @var TpLcrRuleDto $tpLcrRuleDto */
        $tpLcrRuleDto = is_null($tpLcrRule)
            ? TpLcrRule::createDto()
            : $this->entityTools->entityToDto($tpLcrRule);

        $tpLcrRuleDto
            ->setTpid($brand->getCgrTenant())
            ->setTenant($brand->getCgrTenant())
            ->setCategory($outgoingRouting->getCgrCategory())
            ->setRpCategory($outgoingRouting->getCgrRpCategory())
            ->setOutgoingRoutingId($outgoingRouting->getId());

        $tpLcrRule = $this->entityTools->persistDto(
            $tpLcrRuleDto,
            $tpLcrRule,
            true
        );

        $outgoingRouting
            ->setTpLcrRule($tpLcrRule);

        $this->entityTools
            ->persist($outgoingRouting);
    }
}
