<?php

/**
 * Class IvozProvider_Klear_Filter_NotificationTemplateMaxDailyUsage
 *
 * Filter Extension Listbox to only display max daily usage notification templates belonging to brand
 */
class IvozProvider_Klear_Filter_NotificationTemplateMaxDailyUsage extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);
        // Add type condition
        $this->_condition[] = "self::type = 'maxDailyUsage'";

        return true;
    }
}
