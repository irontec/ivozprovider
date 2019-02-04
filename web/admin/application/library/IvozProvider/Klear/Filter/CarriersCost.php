<?php

/**
 * Class IvozProvider_Klear_Filter_CarriersCost
 *
 * Filter Carriers Multiselect to only display carriers with cost enabled
 */
class IvozProvider_Klear_Filter_CarriersCost extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = array(
            "outgoingRoutingList_screen",
            "outgoingRoutingDel_dialog",
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        // Add type condition
        $this->_condition[] = "self::calculateCost = '1'";

        return true;
    }
}
