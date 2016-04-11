<?php
class Oasis_Klear_Filter_BrandLanguages implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $languagesIds = array();

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            //TODO Exceptionante
            throw new Klear_Exception_Default("No brand emulated");
        }
        $loggedUser = $auth->getIdentity();
        $brandyId = $loggedUser->brandId;

        $brandsRelLanguagesMapper = new \Oasis\Mapper\Sql\BrandsRelLanguages();
        $brandRelLanguages = $brandsRelLanguagesMapper->findByField("brandId", $brandyId);
        foreach ($brandRelLanguages as $brandRelLanguage) {
            $languagesIds[] = $brandRelLanguage->getLanguageId();
        }

        $this->_condition[] = "`id` in ('".implode("', '", $languagesIds)."')";

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }
}
