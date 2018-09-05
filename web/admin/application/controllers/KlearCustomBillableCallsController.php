<?php

use IvozProvider\Service\RestClient;

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

        $billableCalls = $apiClient->getBillableCalls();

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
