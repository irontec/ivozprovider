<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntity;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityDto;

class IvozProvider_Klear_Filter_PublicEntities implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = [
            "administratorRelPublicEntitiesList_screen",
        ];

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        // Get parent admin
        $adminId = $huntGroupId = $routeDispatcher->getParam("parentId", false);
        if (!$adminId) {
            return true;
        }

        // Get current object id
        $pk = (int) $routeDispatcher->getParam("pk", false);

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var AdministratorRelPublicEntityDto[] $rels */
        $rels = $dataGateway->findBy(
            AdministratorRelPublicEntity::class,
            ['AdministratorRelPublicEntity.administrator = ' . $adminId]
        );

        $alreadyAssignedEntities = [];
        foreach ($rels as $rel) {
            if ($rel->getId() === $pk) {
                continue;
            }

            $alreadyAssignedEntities[] = $rel->getPublicEntityId();
        }

        if (empty($alreadyAssignedEntities)) {
            return true;
        }

        $this->_condition = [
            'self::id not in (:alreadyAssignedEntities)',
            ['alreadyAssignedEntities' => $alreadyAssignedEntities]
        ];

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return $this->_condition;
        }

        return null;
    }
}
