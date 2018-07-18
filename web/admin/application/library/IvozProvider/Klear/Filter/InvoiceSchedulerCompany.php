<?php

use Ivoz\Core\Application\Service\DataGateway;

class IvozProvider_Klear_Filter_InvoiceSchedulerCompany extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $callerScreen = $routeDispatcher->getParam('callerScreen', false);
        if (!$callerScreen) {
            return;
        }

        $schedulerId = $routeDispatcher->getParam("pk", false);
        if (is_array($schedulerId)) {
            return true;
        }

        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var array $companyIdsInUse */
        $companyIdsInUse = $dataGateway->runNamedQuery(
            \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler::class,
            'getCompanyIdsInUse',
            [$schedulerId]
        );

        if (empty($companyIdsInUse)) {
            return true;
        }

        $this->_condition[] = "self::id NOT IN (" . implode(',', $companyIdsInUse) . ")";

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
    }
}
