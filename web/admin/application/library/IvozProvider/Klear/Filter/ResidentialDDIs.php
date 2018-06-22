<?php

/**
 * Class IvozProvider_Klear_Filter_ResidentialDDIs
 *
 * Filter DDIs Listbox to only display DDIs assigned to the Residential Device being edited
 *
 */
class IvozProvider_Klear_Filter_ResidentialDDIs implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Get current pk
        $pk = $routeDispatcher->getParam("pk", false);
        $this->_condition[] = "self::residentialDevice = '" . $pk . "'";

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return null;
    }
}
