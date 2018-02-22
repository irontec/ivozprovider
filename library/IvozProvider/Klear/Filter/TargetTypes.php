<?php

use \IvozProvider\Mapper\Sql as Mapper;
use \IvozProvider\Model\Companies as Companies;

class IvozProvider_Klear_Filter_TargetTypes implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        return true;
    }

    /**
     * Get target types to be excluded by company type
     * @return array
     */
    public function getCondition()
    {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $companyMapper = new Mapper\Companies;
        $company = $companyMapper->find($user->companyId);

        if (is_null($company)) {
            // No company to filter by
            return [];
        }

        $excludedRoutes = [];

        if ($company->getType() === Companies::RETAIL) {
            $excludedRoutes[] = "extension";
        }

        return $excludedRoutes;
    }
}
