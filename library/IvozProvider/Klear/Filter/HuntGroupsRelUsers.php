<?php

class IvozProvider_Klear_Filter_HuntGroupsRelUsers extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        $huntGroupId = $routeDispatcher->getParam("parentId", false);
        if (!$huntGroupId) {
            return true;
        }

        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto $huntGroupDto */
        $huntGroupDto = $dataGateway->find(
            'Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup',
            $huntGroupId
        );

        if ($huntGroupDto->getStrategy() !== 'ringAll') {
            return true;
        }

        /** @var Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto[] $existingRelationships */
        $existingRelationships = $dataGateway->findBy(
            'Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser',
            ["HuntGroupsRelUser.huntGroup = " . $huntGroupId]
        );

        if (empty($existingRelationships)) {
            return true;
        }

        $userIdsInUse = [];
        foreach ($existingRelationships as $existingRelationship) {
            $userIdsInUse[] = $existingRelationship->getUserId();
        }

        $this->_condition[] = "self::id NOT IN (" . implode(',', $userIdsInUse) . ")";

        return true;
    }
}
