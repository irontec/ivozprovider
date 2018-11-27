<?php

use IvozProvider\Service\RestClient;
use Ivoz\Provider\Domain\Service\BillableCall\CsvExporter;

class KlearCustomBillableCallsController extends Zend_Controller_Action
{
    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter))) {
            throw New Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function exportToCsvAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        $apiClient = new RestClient(
            $user->token,
            $user->refreshToken
        );

        $config = $this->_mainRouter->getCurrentItem()->getConfig();
        $criteria = $config->getProperty("forcedValues");
        $criteria = $criteria
            ? $criteria->toArray()
            : [];

        $criteria['_properties'] = CsvExporter::BRAND_PROPERTIES;

        $requestFile = $this->_request->getParam('file');
        switch($requestFile) {
            case 'BillableCallsList':
                $criteria['_properties'][] = 'brand';
                $criteria['_properties'][] = 'company';
                break;
            case 'BillableCallsBrandList':
                $criteria['_properties'][] = 'company';
                break;
            default:
                $criteria['_properties'] = CsvExporter::CLIENT_PROPERTIES;
        }

        $requestParams = $this->_request->getParam('post', null);
        $where = [];

        if (isset($requestParams) && array_key_exists('searchFields', $requestParams)) {
            foreach($requestParams['searchFields'] as $field => $values) {
                foreach ($values as $key => $value) {
                    $value = urldecode($value);
                    switch ($requestParams['searchOps'][$field][$key]) {
                        case 'eq':
                            $where[$field] = $value;
                            break;
                        case 'lt':
                            $argument = $field . '[strictly_before]';
                            $where[$argument] = $value;
                            break;
                        case 'gt':
                            $argument = $field . '[strictly_after]';
                            $where[$argument] = $value;
                            break;
                    }
                }
            }
        }

        $criteria += $where;

        $billableCalls = $apiClient->getBillableCalls($criteria);
        $response = $this->getResponse();
        $response->clearHeaders();
        $response->setHeader('Content-Length', mb_strlen($billableCalls));
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-disposition', 'attachment; filename=calls.csv');

        $response->sendHeaders();
        $response->clearHeaders();

        echo $billableCalls;
    }
}
