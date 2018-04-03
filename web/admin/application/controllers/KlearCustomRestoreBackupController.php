<?php
class KlearCustomRestoreBackupController extends Zend_Controller_Action
{
    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter)) ) {
            throw New Zend_Exception('',Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->ContextSwitch()
            ->addActionContext('restore-specific-backup', 'json')
            ->addActionContext('restore-generic-backup', 'json')
            ->initContext('json');

        $this->_helper->layout->disableLayout();
    }

    public function restoreGenericBackupAction()
    {
        $this->restoreBackup('generic');
    }

    public function restoreSpecificBackupAction(){
        $this->restoreBackup('specific');
    }

    private function restoreBackup($file){
        $id = $this->_mainRouter->getParam('pk');
        $path = $this->getPath();
        $filename = ($path. DIRECTORY_SEPARATOR . "Provision_template" . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $file . '.phtml.back');

        if ($this->getRequest()->getParam("backup")) {
            $this->_helper->viewRenderer->setNoRender(true);
            $file = fopen($filename, "r");
            $filecontent = fread($file, filesize($filename));
            $data = array(
                    'title' => _("Restore backup"),
                    'message'=>_("Loading") . "<textarea style=\"display: none\">" . str_replace("<br/>", "\n", $filecontent) . "</textarea>"
            );
        } else{
            $existsBackup = file_exists($filename);
            if($existsBackup){
                $message = "Restore backup from " . date ("d m Y H:i:s.", filemtime($filename));
            } else {
                $message = "No backup found.";
            }

            $data = array(
                    'title' => _("Restore backup"),
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


    private function getPath(){
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $path = $conf->Iron['fso']['localStoragePath'];
        return $path;
    }
}
