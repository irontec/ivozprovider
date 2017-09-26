<?php

class IvozProvider_Klear_Filter_ForwardExtension extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        throw new \Exception('Not implemented yet');
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        //Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        // Get Original User Id
        $pk = $routeDispatcher->getParam("parentId", false);
        $userMapper = new \IvozProvider\Mapper\Sql\Users;
        $user = $userMapper->find($pk);

        // If user has extension, filter it out
        if ($user && $user->getExtensionId()) {
            $this->_condition[] = "`id` != " . $user->getExtensionId();
        }
        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return;
    }

}
