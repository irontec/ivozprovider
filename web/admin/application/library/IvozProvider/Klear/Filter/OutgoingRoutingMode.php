<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

/**
 * Class IvozProvider_Klear_Filter_OutgoingRoutingMode
 *
 * Filter OutgoingRouting routingMode Listbox to only display the routeMode selected durint the creation
 * This is require to avoid modification in edit screen and apply visualFilter at the same time
 */
class IvozProvider_Klear_Filter_OutgoingRoutingMode implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    /**
     * @var OutgoingRoutingDto
     */
    protected $outgoingRouting;

    /**
     * @param KlearMatrix_Model_RouteDispatcher $routeDispatcher
     * @return bool
     * @throws Zend_Exception
     */
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = array(
            "outgoingRoutingList_screen",
            "outgoingRoutingNew_screen",
            "outgoingRoutingDel_dialog",
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        // Get current object id
        $outgoingRoutingId = $routeDispatcher->getParam("pk", false);

        if ($outgoingRoutingId) {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            /** @var OutgoingRoutingDto $outgoingRouting */
            $this->outgoingRouting = $dataGateway->find(OutgoingRouting::class, $outgoingRoutingId);
        }
        return true;
    }

    /**
     * Avoid changing RoutingMode by removing the rest of routing Modes
     * @return array
     */
    public function getCondition()
    {
        $excludedRoutingModes = [];

        if ($this->outgoingRouting) {
            switch ($this->outgoingRouting->getRoutingMode()) {
                case OutgoingRouting::MODE_LCR:
                    $excludedRoutingModes[] = OutgoingRouting::MODE_STATIC;
                    break;
                case OutgoingRouting::MODE_STATIC:
                    $excludedRoutingModes[] = OutgoingRouting::MODE_LCR;
                    break;
            }
        }

        return $excludedRoutingModes;
    }
}
