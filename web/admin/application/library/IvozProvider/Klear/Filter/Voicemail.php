<?php

/**
 * Class IvozProvider_Klear_Filter_Voicemail
 *
 * Filter Voicemail Listbox to only display Users with Voicemail setting enabled
 */
class IvozProvider_Klear_Filter_Voicemail extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        // Only show users with voicemail enabled
        $this->_condition[] = "self::enabled = 1";

        return true;
    }
}
