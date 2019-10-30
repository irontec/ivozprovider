<?php

/**
 * Class IvozProvider_Klear_Filter_Brand
 *
 * Filter results for the current emulated brand
 *
 * @note multiple filters inherit from this one
 */
class IvozProvider_Klear_Filter_Brand implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {

        // Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $brandOwnedScreens = array(
            "brandsList_screen",
            "brandsEdit_screen",
        );

        if (in_array($currentItemName, $brandOwnedScreens)) {
            $currentBrandyId =  $routeDispatcher->getParam("pk", false);
        } else {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new Klear_Exception_Default('No brand emulated');
            }

            $loggedUser = $auth->getIdentity();
            $currentBrandyId = $loggedUser->brandId;
        }

        $this->_condition[] = "self::brand = '" . $currentBrandyId . "'";

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
