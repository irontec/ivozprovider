<?php
class IvozProvider_Klear_Filter_Features implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("No company/brand emulated");
        }
        $currentBrandId = $auth->getIdentity()->brandId;

        $mapper = new \IvozProvider\Mapper\Sql\FeaturesRelBrands();
        $rels = $mapper->fetchList("brandId='" . $currentBrandId . "'");

        $featureIds = array();
        foreach ($rels as $rel) {
            $featureId = $rel->getFeatureId();
            if ($featureId == 6) continue; # Exclude 'billing'
            if ($featureId == 7) continue; # Exclude 'invoices'
            array_push($featureIds, $featureId);
        }

        if (count($featureIds)) {
            $this->_condition[] = "`id` IN (" . implode(',', $featureIds) .")";
        } else {
            $this->_condition[] = "`id`=NULL";
        }

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
