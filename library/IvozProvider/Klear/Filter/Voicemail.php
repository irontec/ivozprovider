<?php
class IvozProvider_Klear_Filter_Voicemail extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);
        // Only show users with voicemail enabled
        $this->_condition[] = "self::voicemailEnabled = 1";
        return true;
    }
}
