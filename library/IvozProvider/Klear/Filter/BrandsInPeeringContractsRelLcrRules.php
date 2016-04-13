<?php
class IvozProvider_Klear_Filter_BrandsInPeeringContractsRelLcrRules implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        //Get ModelName and your Controller
        $currentScreen = $routeDispatcher->getCurrentItemName();

        //NUESTRA CONDICIÓN CON CODIO WHERE MYSQL
        $pk = $routeDispatcher->getParam("pk", false);

        //Screen de la que partimos
        $file = $routeDispatcher->getParam("file", false);
        $parentId = $routeDispatcher->getParam("parentId", false);
        $parentScreen = $routeDispatcher->getParam("parentScreen", false);
        $camingFromParentScreen = $parentScreen !== false; 

        $editableScreens = array(
            "peeringContractsRelLcrRulesNew_screen",
            "peeringContractsRelLcrRulesEdit_screen"
        );
        $isEditableScreen = in_array($currentScreen, $editableScreens);

        if ($camingFromParentScreen && $isEditableScreen) {

            if ('PeeringContractsList' == $file) {

                $peeringContractMapper = new \IvozProvider\Mapper\Sql\PeeringContracts;
                $peeringContract = $peeringContractMapper->find($parentId);

                if (!$peeringContract) {
                    return true;
                }

                $this->_condition[] = "`id` = '". $peeringContract->getBrandId() ."'";
            } else if ('LcrRulesList' == $file) {
                    
                $lcrRulesMapper = new \IvozProvider\Mapper\Sql\LcrRules;
                $lcrRule = $lcrRulesMapper->find($parentId);

                if (!$lcrRule) {
                    return true;
                }

                $this->_condition[] = "`id` = '". $lcrRule->getBrandId() ."'";
                
            } else {
                throw new \Exception("Filter for "+ $file +" not implemented", 500);
            }

            
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            //throw new \Exception('(' . implode(" AND ", $this->_condition) . ')');
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }
}
