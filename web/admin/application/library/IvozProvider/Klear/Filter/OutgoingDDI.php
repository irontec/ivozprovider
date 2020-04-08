<?php

/**
 * Class IvozProvider_Klear_Filter_OutgoingDDI
 *
 * Filter OutgoingDDI Listbox to only display DDIs belonging to edited company/retail
 * We can not use traditional company filtering here because it only works with emulated company
 */
class IvozProvider_Klear_Filter_OutgoingDDI implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $file = $routeDispatcher->getParam('file');
        $useDynamicFilter = in_array(
            $file,
            [
                'CallCsvSchedulersList',
                'CallCsvSchedulersBrandList'
            ],
            true
        );

        if ($useDynamicFilter) {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new Klear_Exception_Default("No company/brand emulated");
            }
            $identity = $auth->getIdentity();

            switch ($file) {
                case 'CallCsvSchedulersList':
                    $currentCompanyId = $identity->companyId;
                    $this->_condition = [
                        'self::company = ' . $currentCompanyId
                    ];

                    return;

                case 'CallCsvSchedulersBrandList':
                    $currentBrandId = $identity->brandId;
                    $this->_condition = [
                        'self::brand = ' . $currentBrandId,
                    ];

                    return;
            }
        }

        // Do not apply company based filtering in list view
        if ($routeDispatcher->getControllerName() == "list") {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new Klear_Exception_Default("No company/brand emulated");
            }
            $currentBrandId = $auth->getIdentity()->brandId;
            $this->_condition = [
                'self::brand = :pk',
                ['pk' => $currentBrandId]
            ];

            return;
        }

        // Get current object id
        $pk = $routeDispatcher->getParam("pk", false);

        // Only display DDIs belonging to edited company
        if (is_array($pk)) {
            //Avoid multiple choice error on klear
            $this->_condition = ["1=2"];
            return true;
        }

        $this->_condition = [
            'self::company = :pk',
            ['pk' => $pk ? $pk  : '']
        ];

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return $this->_condition;
        }

        return null;
    }
}
