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
        $dataGateway = \Zend_Registry::get('data_gateway');
        /**
         * @var \Ivoz\Provider\Domain\Model\User\UserInterface $user
         */
        $user = $dataGateway->find(
            '\Ivoz\Provider\Domain\Model\User\User',
            $pk
        );

        // If user has extension, filter it out
        if ($user && $user->getExtension() && $user->getExtension()->getId()) {
            $this->_condition[] = "self::id != " . $user->getExtension()->getId();
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
