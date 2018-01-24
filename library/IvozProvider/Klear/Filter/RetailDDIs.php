<?php

/**
 * Class IvozProvider_Klear_Filter_RetailDDIs
 *
 * Filter DDIs Listbox to only display DDIs assigned to the Retail Account being edited
 *
 */
class IvozProvider_Klear_Filter_RetailDDIs implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Get current pk
        $pk = $routeDispatcher->getParam("pk", false);
        $this->_condition[] = "self::retailAccount = '" . $pk . "'";

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
