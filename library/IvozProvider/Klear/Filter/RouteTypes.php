<?php

use \IvozProvider\Mapper\Sql as Mapper;
use \IvozProvider\Model\Companies as Companies;

class IvozProvider_Klear_Filter_RouteTypes implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        return true;
    }

    /**
     * Get route types to be excluded by company features
     * @return array
     */
    public function getCondition()
    {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $featureMapper = new Mapper\Features;
        $features = $featureMapper->fetchList();

        $companyMapper = new Mapper\Companies;
        $company = $companyMapper->find($user->companyId);

        if (is_null($company)) {
            // No company feature to filter by
            return [];
        }

        $excludedRoutes = [];
        foreach ($features as $feature) {
            switch ($feature->getName('en')) {
                case "Queues":      $routeType = 'queue'; break;
                case "Friends":     $routeType = 'friend'; break;
                case "Faxes":       $routeType = 'fax'; break;
                case "Conferences": $routeType = 'conferenceRoom'; break;
                default: $routeType = "";
            }

            if (!empty($routeType) && !$company->hasFeature($feature->getId())) {
                $excludedRoutes[] = $routeType;
            }
        }

        if ($company->getType() === Companies::VPBX) {
            $excludedRoutes[] = "retailAccount";
        } else {
            $excludedRoutes[] = "user";
            $excludedRoutes[] = "IVRCommon";
            $excludedRoutes[] = "IVRCustom";
            $excludedRoutes[] = "huntGroup";
            $excludedRoutes[] = "conditional";
        }

        return $excludedRoutes;
    }
}
