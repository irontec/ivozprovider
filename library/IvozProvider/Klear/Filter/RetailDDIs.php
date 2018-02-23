<?php
class IvozProvider_Klear_Filter_RetailDDIs implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = array(
            "retailAccountsList_screen",
            "retailAccountsDel_dialog",
            "callForwardSettingsDel_dialog",
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        // Get current pk
        $pk = $routeDispatcher->getParam("pk", false);
        $this->_condition[] = "`retailAccountId` = '" . $pk . "'";

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }
}
