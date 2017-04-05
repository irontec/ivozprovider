<?php

use \IvozProvider\Mapper\Sql as Mapper;

class IvozProvider_Klear_Filter_RouteTypes implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        return true;
    }

    public function getCondition()
    {
        $excludedRoutes = array();
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $featureMapper = new Mapper\Features;
        $features = $featureMapper->fetchList();

        $companyMapper = new Mapper\Companies;
        $company = $companyMapper->find($user->companyId);

        foreach ($features as $feature) {
            switch ($feature->getName('en')) {
                case "Queues":      $routeType = 'queue'; break;
                case "Friends":     $routeType = 'friend'; break;
                case "Faxes":       $routeType = 'fax'; break;
                case "Conferences": $routeType = 'conferenceRoom'; break;
                default: $routeType = "";
            }

            if (!empty($routeType) && !$company->hasFeature($feature->getId())) {
                array_push($excludedRoutes, $routeType);
            }
        }

        return $excludedRoutes;
    }
}
