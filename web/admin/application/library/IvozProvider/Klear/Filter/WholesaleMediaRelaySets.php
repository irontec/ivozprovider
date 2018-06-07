<?php

/**
 * Class IvozProvider_Klear_Filter_WholesaleMediaRelaySets
 *
 * Filter MediaRelaySets Listbox to only display rtpengine sets in wholesale configuration screen
 *
 */
class IvozProvider_Klear_Filter_WholesaleMediaRelaySets extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $this->_condition[] = "self::type  = 'rtpengine'";
        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" OR ", $this->_condition) . ')'];
        }
        return null;
    }
}
