<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandDto;

/**
 * Class IvozProvider_Klear_Filter_ProxyTrunks
 *
 * Filter ProxyTrunks Multiselect to avoid selecting ProxyTrunks not enabled by the Brand
 */
class IvozProvider_Klear_Filter_ProxyTrunks implements KlearMatrix_Model_Field_Select_Filter_Interface
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

        /** @var ProxyTrunksRelBrandDto[] $rels */
        $rels = $dataGateway->findBy(
            ProxyTrunksRelBrand::class,
            ["ProxyTrunksRelBrand.brand = '" . $currentBrandId . "'"]
        );

        $proxyTrunkIds = [];
        foreach ($rels as $rel) {
            $proxyTrunkId = $rel->getProxyTrunkId();
            $proxyTrunkIds[] = $proxyTrunkId;
        }

        if (count($proxyTrunkIds)) {
            $this->_condition[] = "self::id IN (" . implode(',', $proxyTrunkIds) . ")";
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
