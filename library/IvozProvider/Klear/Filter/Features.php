<?php

use Ivoz\Provider\Domain\Model\Feature\Feature as Feature;

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

        $dataGateway = \Zend_Registry::get('data_gateway');
        /**
         * @var \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto[] $rels
         */
        $rels = $dataGateway->findBy(
            'Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand',
            ["FeaturesRelBrand.brand = '" . $currentBrandId . "'"]
        );

        $featureIds = [];
        foreach ($rels as $rel) {
            $featureId = $rel->getFeatureId();
            if ($featureId == Feature::BILLING) continue;
            if ($featureId == Feature::INVOICES) continue;
            if ($featureId == Feature::RETAIL) continue;
            $featureIds[] = $featureId;
        }

        if (count($featureIds)) {
            $this->_condition[] = "self::id IN (" . implode(',', $featureIds) .")";
        } else {
            $this->_condition[] = "self::id = NULL";
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
