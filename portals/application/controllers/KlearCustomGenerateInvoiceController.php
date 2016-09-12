<?php

class KlearCustomGenerateInvoiceController extends Zend_Controller_Action
{

    protected $_mainRouter;

    protected $_brandId;

    public function init ()
    {
        /**
         * Initialize action controller here
         */
        if ((! $this->_mainRouter = $this->getRequest()->getUserParam(
                "mainRouter")) || (! is_object($this->_mainRouter))) {
            throw new Zend_Exception("",
                    Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
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

    protected function _confirmDialog ()
    {
        $_haveError = $this->_searchError();

        if ($_haveError) {
            $data = $_haveError;
        } else {
            $title = $this->_helper->translate("Generate invoice");
            $message = $this->_helper->translate("Are you sure you want to generate the invoice?");
            $okButton = $this->_helper->translate("OK");
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
        }

        $this->_dispatch($data);
    }

    protected function _searchError ()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks)) {
            $pks = array($pks);
        }

        $invoicesMapper = new \IvozProvider\Mapper\Sql\Invoices();
        foreach ($pks as $pk) {
            $invoice = $invoicesMapper->find($pk);

            $invoiceTz = $invoice->getCompany()->getDefaultTimezone()->getTz();
            $inDate = $invoice->getInDate(true);
            $inDate->setTimezone($invoiceTz);
            $outDate = $invoice->getOutDate(true);
            $outDate->setTimezone($invoiceTz);
            $outDate->addDay(1)->subSecond(1);

            $now = new \Zend_Date();
            $now->setTimezone($invoiceTz);
            $inDateIsInFuture = $invoice->getInDate(true)->getDate()->compare($now->getDate()) >= 0;
            $outDateIsInFuture = $invoice->getOutDate(true)->getDate()->compare($now->getDate()) >= 0;

            $closeButton = $this->_helper->translate("Close");

            if ($inDateIsInFuture || $outDateIsInFuture) {
                $title = 'Error 50006';
                $message = $this->_helper->translate("Cannot invoice calls from today in the future.");

                $data = array(
                    'title' => $title,
                    'message' => $message,
                    'buttons' => array(
                        $closeButton => array(
                            "recall" => false,
                            "reloadParent" => false
                        )
                    )
                );

                return $data;
            }


            $callMapper = new \IvozProvider\Mapper\Sql\KamAccCdrs();

            $wheres = array(
                "companyId = '".$invoice->getCompanyId()."'",
                "brandId = '".$invoice->getBrandId()."'",
                "start_time_utc < '".$inDate->toString('yyyy-MM-dd HH:mm:ss')."'",
                "(invoiceId is null OR invoiceId = '".$invoice->getPrimaryKey()."')"
            );

            $unbilledCalls = $callMapper->fetchTarificableList($wheres);
            if (!empty($unbilledCalls)) {
                $title = 'Error 50002';
                $message = $this->_helper->translate("There are unbilled calls before in date.");

                $data = array(
                    'title' => $title,
                    'message' => $message,
                    'buttons' => array(
                        $closeButton => array(
                            "recall" => false,
                            "reloadParent" => false
                        )
                    )
                );

                return $data;
            }
        }

        return false;
    }

    protected function _generateDialog ()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks)) {
            $pks = array($pks);
        }

        $invoicesMapper = new \IvozProvider\Mapper\Sql\Invoices();
        foreach ($pks as $pk) {
            $invoice = $invoicesMapper->find($pk);
            $invoice->setStatus("waiting")->save();

            $invoicerJob = new \IvozProvider\Gearmand\Jobs\Invoicer();
            $invoicerJob->setPk($pk)->send();
        }

        if (count($pks) == 1) {
            $title = $this->_helper->translate("Invoice enqueued");
            $message = $this->_helper->translate("Invoice has been enqueued. It will be generated as soon as posible.");
        } else {
            $n = count($pks);
            $title = $this->_helper->translate("Invoices enqueued: ").$n;
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

    protected function _dispatch (array $data)
    {
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('klearMatrix');
        $jsonResponse->setPlugin('klearMatrixGenericDialog');
        $jsonResponse->addJsFile(
                '/js/plugins/jquery.klearmatrix.genericdialog.js');
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}

