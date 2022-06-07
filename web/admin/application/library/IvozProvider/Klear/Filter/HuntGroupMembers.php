<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMember;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberDto;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;

/**
 * Class IvozProvider_Klear_Filter_HuntGroupMembers
 *
 * Filter Users Listbox to avoid displaying Users already present in the HuntGroup
 */
class IvozProvider_Klear_Filter_HuntGroupMembers extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        $controller = $routeDispatcher->getControllerName();
        if (!in_array($controller, ['edit', 'new'])) {
            return true;
        }

        $screen = $routeDispatcher->getCurrentScreen();
        $filterField = $screen->getFilterField();

        if ($filterField !== 'HuntGroup') {
            return true;
        }

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

        $condition = "HuntGroupMember.huntGroup = " . $huntGroupId;
        $currentPk = $routeDispatcher->getParam("pk", false);
        $isEditScreen = $routeDispatcher->getControllerName() === 'edit';
        if ($isEditScreen && $currentPk) {
            $condition .= ' AND HuntGroupMember.id != ' . $currentPk;
        }

        /** @var HuntGroupMemberDto[] $existingRelationships */
        $existingRelationships = $dataGateway->findBy(
            HuntGroupMember::class,
            [$condition]
        );

        if (empty($existingRelationships)) {
            return true;
        }

        $userIdsInUse = [];
        foreach ($existingRelationships as $existingRelationship) {
            if ($existingRelationship->getRouteType() == HuntGroupMemberInterface::ROUTETYPE_USER) {
                $userIdsInUse[] = $existingRelationship->getUserId();
            }
        }

        if (!empty($userIdsInUse)) {
            $this->_condition[] = "self::id NOT IN (" . implode(',', $userIdsInUse) . ")";
        }

        return true;
    }
}
