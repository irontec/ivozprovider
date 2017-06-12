<?php

use \Ivozprovider\Model\Features as Features;

class IvozProvider_Klear_Filter_RetailFeatures implements KlearMatrix_Model_Field_Select_Filter_Interface
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

        $excludedFeatures = array(
            Features::QUEUES,
            Features::FRIENDS,
            Features::CONFERENCES,
            Features::BILLING,
            Features::INVOICES,
            Features::RETAIL,
        );

        $featureIds = [];
        foreach ($rels as $rel) {
            $featureId = $rel->getFeatureId();
            // Ignore features not related with Retail Clients
            if (in_array($featureId, $excludedFeatures)) {
                continue;
            }
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
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }
}
