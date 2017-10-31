<?php

class IvozProvider_Klear_Filter_CompanyPricingPlansPrices implements KlearMatrix_Model_Interfaces_FilterList
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

           /**
            * @var \Ivoz\Core\Application\Service\DataGateway $dataGateway
            */
           $dataGateway = \Zend_Registry::get('data_gateway');

           /**
            * @var \Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompanyDTO $companyPlan
            */
           $companyPlan = $dataGateway->find(
               'Ivoz\\Provider\\Domain\\Model\\PricingPlansRelCompany\\PricingPlansRelCompany',
               $pk
           );

           $this->_condition = [
               "self::pricingPlan = " . $companyPlan->getPricingPlanId()
           ];
           return true;
       }

       public function getCondition()
       {
            if (count($this->_condition) > 0) {
                return ['(' . implode(" AND ", $this->_condition) . ')'];
            }

            return $this->_condition;
       }
   }