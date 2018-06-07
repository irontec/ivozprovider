<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class CreateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class CreateByOutgoingRoutingBinding implements OutgoingRoutingLifecycleEventHandlerInterface
{
    /**
     * @var CreateByOutgoingRouting
     */
    protected $createByOutgoingRouting;

    public function __construct(CreateByOutgoingRouting $createByOutgoingRouting)
    {
        $this->createByOutgoingRouting = $createByOutgoingRouting;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        $this->createByOutgoingRouting->execute($outgoingRouting);
    }
}