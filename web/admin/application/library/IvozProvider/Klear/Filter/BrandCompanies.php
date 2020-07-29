<?php

use Ivoz\Provider\Domain\Model\Company\Company;

/**
 * Class IvozProvider_Klear_Filter_BrandCompanies
 *
 * Filter results for the current emulated brand
 *
 * @note multiple filters inherit from this one
 */
class IvozProvider_Klear_Filter_BrandCompanies implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $file = $routeDispatcher->getParam('file');
        $clientFilteredScreens = [
            'CallCsvSchedulersList'
        ];

        if (in_array($file, $clientFilteredScreens)) {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new Klear_Exception_Default('Unable to get user identity');
            }

            $loggedUser = $auth->getIdentity();
            $currentCompanyId = $loggedUser->companyId;
            $this->_condition[] = "self::company in (" . $currentCompanyId . ")";

            return true;
        }

        // Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $brandOwnedScreens = array(
            "brandsList_screen",
            "brandsEdit_screen",
        );

        if (in_array($currentItemName, $brandOwnedScreens)) {
            $currentBrandyId =  $routeDispatcher->getParam("pk", false);
        } else {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new Klear_Exception_Default('No brand emulated');
            }

            $loggedUser = $auth->getIdentity();
            $currentBrandyId = $loggedUser->brandId;
        }

        $subQuery = sprintf(
            'SELECT Company.id from %s AS Company WHERE Company.brand = %d',
            Company::class,
            $currentBrandyId
        );

        $this->_condition[] = "self::company in (" . $subQuery . ")";

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return null;
    }
}
