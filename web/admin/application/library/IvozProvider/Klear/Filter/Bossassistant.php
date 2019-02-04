<?php

/**
 * Class IvozProvider_Klear_Filter_Bossassistant
 *
 * Filter Boss-Assistant Listbox to avoid selecting Users with Boss flag enabled as Assistant
 */
class IvozProvider_Klear_Filter_Bossassistant extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        $pk = $routeDispatcher->getParam("pk", false);

        if (!is_array($pk)) {
            $this->_condition[] = "self::id != $pk";
            $this->_condition[] = "self::isBoss = 0";
        }

        return true;
    }
}
