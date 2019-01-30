<?php

use Ivoz\Provider\Domain\Model\Invoice\Invoice;

class KlearCustomGenerateInvoiceController extends Zend_Controller_Action
{

    protected $_mainRouter;

    protected $_brandId;

    public function init()
    {
        /**
         * Initialize action controller here
         */
        if ((! $this->_mainRouter = $this->getRequest()->getUserParam(
            "mainRouter"
        )) || (! is_object($this->_mainRouter))) {
            throw new Zend_Exception(
                "",
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
        }

        $this->_helper->ContextSwitch()
            ->addActionContext("generate", "json")
            ->initContext("json");

        $this->_helper->layout->disableLayout();

        $auth = Zend_Auth::getInstance();
        if (! $auth->hasIdentity()) {
            // TODO Exceptionante
            throw new Klear_Exception_Default("No brand emulated");
        }
        $loggedUser = $auth->getIdentity();
        $this->_brandId = $loggedUser->brandId;
    }

    public function generateAction()
    {
        $generate = $this->getRequest()->getParam("generate", false);
        if ($generate === false) {
            $this->_confirmDialog();
        } else {
            $this->_generateDialog();
        }
    }

    protected function _confirmDialog()
    {
        $title = $this->_helper->translate("Generate invoice");
        $message = $this->_helper->translate("Are you sure you want to generate the invoice?");
        $okButton = $this->_helper->translate("Accept");
        $closeButton = $this->_helper->translate("Close");

        $data = array(
            'title' => $title,
            'message' => $message,
            'buttons' => array(
                $closeButton => array(
                    "recall" => false,
                    "reloadParent" => false
                ),
                $okButton => array(
                    "recall" => true,
                    "reloadParent" => false,
                    "params" => array(
                        "generate" => true
                    )
                )
            )
        );

        $this->_dispatch($data);
    }

    protected function _generateDialog()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks)) {
            $pks = array($pks);
        }

        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        foreach ($pks as $pk) {
            $invoice = $dataGateway->find(Invoice::class, $pk);
            $invoice->setStatus("waiting");
            $dataGateway->update(Invoice::class, $invoice);
        }

        if (count($pks) == 1) {
            $title = $this->_helper->translate("Invoice(s) enqueued");
            $message = $this->_helper->translate("Invoice has been enqueued. It will be generated as soon as posible.");
        } else {
            $n = count($pks);
            $title = $this->_helper->translate("Invoice(s) enqueued") . ": " . $n;
            $message = $this->_helper->translate("Invoices have been enqueued. They will be generated as soon as posible.");
        }
        $closeButton = $this->_helper->translate("Close");

        $data = array(
            'title' => $title,
            'message' => $message,
            'buttons' => array(
                $closeButton => array(
                    "recall" => false,
                    "reloadParent" => true
                )
            )
        );
        $this->_dispatch($data);
    }

    protected function _dispatch(array $data)
    {
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('klearMatrix');
        $jsonResponse->setPlugin('klearMatrixGenericDialog');
        $jsonResponse->addJsFile('/js/plugins/jquery.klearmatrix.genericdialog.js');
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
