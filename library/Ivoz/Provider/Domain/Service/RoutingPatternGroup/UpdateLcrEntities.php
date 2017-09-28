<?php
namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Service\LcrRule\UpdateByOutgoingRouting;
use Ivoz\Provider\Domain\Service\LcrGateway\CreateByOutgoingRouting;

/**
 * Class UpdateLcrEntities
 * @lifecycle post_persist
 */
class UpdateLcrEntities implements RoutingPatternGroupLifecycleEventHandlerInterface
{
    /**
     * @var UpdateByOutgoingRouting
     */
    protected $updateLcrRuleByOutgoingRouting;

    /**
     * @var CreateByOutgoingRouting
     */
    protected $createLcrGatewayByOutgoingRouting;

    public function __construct(
        UpdateByOutgoingRouting $updateLcrRuleByOutgoingRouting,
        CreateByOutgoingRouting $createLcrGatewayByOutgoingRouting
    ) {
        $this->updateLcrRuleByOutgoingRouting = $updateLcrRuleByOutgoingRouting;
        $this->createLcrGatewayByOutgoingRouting = $createLcrGatewayByOutgoingRouting;
    }

    public function execute(RoutingPatternGroupInterface $entity, $isNew)
    {
        if ($isNew) {
            return;
        }

        /**
         * @var OutgoingRoutingInterface[] $outgoingRoutings
         */
        $outgoingRoutings = $entity->getOutgoingRoutings();

        // If any LcrRule uses this PatternGroup, update accordingly
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->updateLcrRuleByOutgoingRouting->execute($outgoingRouting);
            $this->createLcrGatewayByOutgoingRouting->execute($outgoingRouting);
        }
    }
}