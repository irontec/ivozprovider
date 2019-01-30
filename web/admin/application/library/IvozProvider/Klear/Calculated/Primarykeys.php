<?php
class IvozProvider_Klear_Calculated_Primarykeys
{
    public function huntGroupPk(KlearMatrix_Model_RouteDispatcher $router)
    {
       /* nuestro código */
        $huntGroupsRelUsersMapper = new \IvozProvider\Mapper\Sql\HuntGroupsRelUsers();
        $huntGroupsRelUsersModel = $huntGroupsRelUsersMapper->find($router->getParam("pk"));
        return $huntGroupsRelUsersModel->getHuntGroupId();
    }
}
