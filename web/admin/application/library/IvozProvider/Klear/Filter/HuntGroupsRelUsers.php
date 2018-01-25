<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto;

/**
 * Class IvozProvider_Klear_Filter_HuntGroupsRelUsers
 *
 * Filter Users Listbox to avoid displaying Users already present in the HuntGroup
 */
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

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var HuntGroupDto $huntGroupDto */
        $huntGroupDto = $dataGateway->find(
            Huntgroup::class,
            $huntGroupId
        );

        if ($huntGroupDto->getStrategy() !== 'ringAll') {
            return true;
        }

        /** @var HuntGroupsRelUserDto[] $existingRelationships */
        $existingRelationships = $dataGateway->findBy(
            HuntGroupsRelUser::class,
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
