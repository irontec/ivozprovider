<?php

/**
 * Class IvozProvider_Klear_Filter_NotificationTemplateVoicemail
 *
 * Filter Extension Listbox to only display voicemail notification templates belonging to brand
 */
class IvozProvider_Klear_Filter_NotificationTemplateVoicemail extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);
        // Add type condition
        $this->_condition[] = "self::type = 'voicemail'";

        return true;
    }
}
