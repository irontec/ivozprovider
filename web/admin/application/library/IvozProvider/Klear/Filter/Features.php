<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto;

/**
 * Class IvozProvider_Klear_Filter_Features
 *
 * Filter Features Multiselect to avoid selecting Features not enabled by the Brand
 */
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

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var FeaturesRelBrandDto[] $rels */
        $rels = $dataGateway->findBy(
            FeaturesRelBrand::class,
            ["FeaturesRelBrand.brand = '" . $currentBrandId . "'"]
        );

        $featureIds = [];
        foreach ($rels as $rel) {
            $featureId = $rel->getFeatureId();
            if ($featureId == Feature::BILLING) {
                continue;
            }
            if ($featureId == Feature::INVOICES) {
                continue;
            }
            if ($featureId == Feature::RESIDENTIAL) {
                continue;
            }
            if ($featureId == Feature::WHOLESALE) {
                continue;
            }
            if ($featureId == Feature::RETAIL) {
                continue;
            }
            if ($featureId == Feature::VPBX) {
                continue;
            }
            $featureIds[] = $featureId;
        }

        if (count($featureIds)) {
            $this->_condition[] = "self::id IN (" . implode(',', $featureIds) .")";
        } else {
            $this->_condition[] = "self::id IS NULL";
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
    }
}
