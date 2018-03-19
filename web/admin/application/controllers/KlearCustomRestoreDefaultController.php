<?php
class KlearCustomRestoreDefaultController extends Zend_Controller_Action
{
    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter)) ) {
            throw New Zend_Exception('',Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->ContextSwitch()
        ->addActionContext('restore-specific-default', 'json')
        ->addActionContext('restore-generic-default', 'json')
        ->initContext('json');

        $this->_helper->layout->disableLayout();
    }

    public function restoreGenericDefaultAction()
    {
        $this->restoreDefault('generic');
    }

    public function restoreSpecificDefaultAction(){
        $this->restoreDefault('specific');
    }

    private function restoreDefault($file)
    {
        $dataGateway = Zend_Registry::get('data_gateway');
        $id = $this->_mainRouter->getParam('pk');

        /** @var \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel $terminalModel */
        $terminalModel = $dataGateway->find(
            \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel::class,
            $id
        );

        $iden = $terminalModel->getIden();
        $filename = "/opt/irontec/ivozprovider/web/admin/templates/provisioning/$iden/$file.cfg";

        if ($this->getRequest()->getParam("backup")) {
            $this->_helper->viewRenderer->setNoRender(true);
            $file = fopen($filename, "r");
            $filecontent = fread($file, filesize($filename));
            $data = array(
                'title' => _("Restore default template"),
                'message' =>
                    _("Loading")
                    . "<textarea style=\"display: none\">"
                    . str_replace("<br/>", "\n", $filecontent)
                    . "</textarea>"
            );
        } else {
            $existsBackup = file_exists($filename);
            if($existsBackup){
                $message = "Reset default template? ($filename)";
            }
            else {
                $message = "No default template found ($filename)";
            }

            $data = array(
                    'title' => _("Restore default template"),
                    'message'=>_($message),
                    'buttons'=>array(
                            _('Accept') => array(
                                    'reloadParent' => false,
                                    'recall' => $existsBackup,
                                    'params'=>array(
                                            "backup" => true
                                    )
                            ),
                            _('Cancel') => array(
                                    'reloadParent' => false,
                                    'recall' => false,
                            )
                    )
            );
        }

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customRestoreBackup');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customRestoreBackup.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}

