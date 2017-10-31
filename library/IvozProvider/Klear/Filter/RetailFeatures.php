<?php

use Ivoz\Provider\Domain\Model\Feature\Feature;
use \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;
use \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDTO;

class IvozProvider_Klear_Filter_RetailFeatures implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();
    protected $_arguments = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("No company/brand emulated");
        }
        $currentBrandId = $auth->getIdentity()->brandId;

        /**
         * @var \Ivoz\Core\Application\Service\DataGateway $dataGateway
         */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /**
         * @var FeaturesRelBrandDTO[] $rels
         */
        $rels = $dataGateway->findBy(
            FeaturesRelBrand::class,
            ['FeaturesRelBrand.brand = ' . $currentBrandId]
        );

        $excludedFeatures = array(
            Feature::QUEUES,
            Feature::FRIENDS,
            Feature::CONFERENCES,
            Feature::BILLING,
            Feature::INVOICES,
            Feature::RETAIL,
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
            $this->_condition[] = 'self::id IN (:featureIds)';
            $this->_arguments = ['featureIds' => $featureIds];
        } else {
            $this->_condition[] = 'self::id is NULL';
        }

        return true;
    }

    public function getCondition()
    {
        return [
            '(' . implode(" AND ", $this->_condition) . ')',
            $this->_arguments
        ];
    }
}
