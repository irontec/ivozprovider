<?php
use \IvozProvider\Model\PricingPlansRelTargetPatterns as RelationModel;
use \IvozProvider\Mapper\Sql\PricingPlansRelTargetPatterns as RelationMapper;
use \IvozProvider\Model\TargetPatterns as PatternModel;
use \IvozProvider\Model\PricingPlans as PlanModel;
class IvozProvider_Klear_Filter_TargetPatternPricingPlans implements KlearMatrix_Model_Interfaces_FilterList
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        throw new \Exception('Not implemented yet');

        //La acción actual
        $currentAction = $routeDispatcher->getActionName();

        //El controller actual (edit, list...)
        $currentController = $routeDispatcher->getControllerName();

        //Para recoger el PK de la pantalla anterior
        $params = $routeDispatcher->getParams();

        if (isset($params['pk'])) {
            $pk = $routeDispatcher->getParam('pk');
        } else {
            $pk = null;
        }

        //Añadir la condición
        if ($pk) {
            $pricesMapper = new RelationMapper();

            $where = "targetPatternId = ". $pk;

            $planPrices = $pricesMapper->fetchList($where);
            $pricingPlanIds = array();


            foreach ($planPrices as $planPrice) {
                if ($pricingPlanId = $planPrice->getPricingPlanId()) {
                    $pricingPlanIds[] = $pricingPlanId;
                }
            }


            if (count($pricingPlanIds) > 0) {
                $condition = "id IN (".implode(",", $pricingPlanIds).")";
            } else {
                $condition = "id = NULL";
            }
        } else {
            $condition = 1;
        }

        $this->_condition[] = $condition;

        return true;
    }

    //Ésta función no debe tocarse
    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return null;
    }
}