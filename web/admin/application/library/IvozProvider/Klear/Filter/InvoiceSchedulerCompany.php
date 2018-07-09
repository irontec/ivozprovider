<?php

use Ivoz\Core\Application\Service\DataGateway;

class IvozProvider_Klear_Filter_InvoiceSchedulerCompany implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $callerScreen = $routeDispatcher->getParam('callerScreen', false);
        if (!$callerScreen) {
            return;
        }

        $schedulerId = $routeDispatcher->getParam("pk", false);

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var array $companyIdsInUse */
        $companyIdsInUse = $dataGateway->runNamedQuery(
            \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler::class,
            'getCompanyIdsInUse',
            [$schedulerId]
        );

        if (empty($companyIdsInUse)) {
            return;
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
