<?php

class Oasis_Klear_Filter_CompanyPricingPlansPrices implements KlearMatrix_Model_Interfaces_FilterList
   {
       protected $_condition = array();

       public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
       {
           //La acción actual
           $currentAction = $routeDispatcher->getActionName();

           //El controller actual (edit, list...)
           $currentController = $routeDispatcher->getControllerName();

           //Para recoger el PK de la pantalla anterior
           $params = $routeDispatcher->getParams();

           if (isset($params['pk'])) {
               $pk = $routeDispatcher->getParam('pk');
           } else {
               return true;
           }

           $companyPlansMapper = new \Oasis\Mapper\Sql\PricingPlansRelCompanies();
           $companyPlan = $companyPlansMapper->find($pk);
           $plan = $companyPlan->getPricingPlan();

           $this->_condition[] = "pricingPlanId = '".$plan->getPrimaryKey()."'";

           return true;
       }

       //Ésta función no debe tocarse
       public function getCondition()
       {
           if (count($this->_condition) > 0) {
               return '(' . implode(" AND ", $this->_condition) . ')';
           }
           return;
       }
   }