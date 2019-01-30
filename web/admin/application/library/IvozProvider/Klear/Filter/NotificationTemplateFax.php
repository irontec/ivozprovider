<?php

/**
 * Class IvozProvider_Klear_Filter_NotificationTemplateFax
 *
 * Filter Extension Listbox to only display voicemail notification templates belonging to brand
 */
class IvozProvider_Klear_Filter_NotificationTemplateFax extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);
        // Add type condition
        $this->_condition[] = "self::type = 'fax'";

        return true;
    }
}
