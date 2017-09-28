<?php
class IvozProvider_Klear_Filter_Voicemail extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        throw new \Exception('Not implemented yet');

        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);
        // Only show users with voicemail enabled
        $this->_condition[] = "`voicemailEnabled` = 1";
        return true;
    }
}
