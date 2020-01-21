<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByOutgoingRouting as LcrRuleUpdateByOutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class UpdateByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = LcrRuleUpdateByOutgoingRouting::POST_PERSIST_PRIORITY + 10;

    /**
     * @var TrunksLcrRuleTargetFactory
     */
    protected $trunksLcrRuleTargetFactory;

    /**
     * UpdateByOutgoingRoutingBinding constructor.
     *
     * @param TrunksLcrRuleTargetFactory $trunksLcrRuleTargetFactory
     */
    public function __construct(
        TrunksLcrRuleTargetFactory $trunksLcrRuleTargetFactory
    ) {
        $this->trunksLcrRuleTargetFactory = $trunksLcrRuleTargetFactory;
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
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        $this->trunksLcrRuleTargetFactory->execute(
            $outgoingRouting
        );
    }
}
