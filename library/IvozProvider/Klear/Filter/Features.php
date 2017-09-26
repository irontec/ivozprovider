<?php

use \IvozProvider\Model\Features as Features;

class IvozProvider_Klear_Filter_Features implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        throw new \Exception('Not implemented yet');
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("No company/brand emulated");
        }
        $currentBrandId = $auth->getIdentity()->brandId;

        $mapper = new \IvozProvider\Mapper\Sql\FeaturesRelBrands();
        $rels = $mapper->fetchList("brandId='" . $currentBrandId . "'");

        $featureIds = [];
        foreach ($rels as $rel) {
            $featureId = $rel->getFeatureId();
            if ($featureId == Features::BILLING) continue;
            if ($featureId == Features::INVOICES) continue;
            if ($featureId == Features::RETAIL) continue;
            $featureIds[] = $featureId;
        }

        if (count($featureIds)) {
            $this->_condition[] = "`id` IN (" . implode(',', $featureIds) .")";
        } else {
            $this->_condition[] = "`id` = NULL";
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return;
    }
}
