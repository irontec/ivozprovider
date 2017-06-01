<?php
class KlearCustomRunCodeController extends Zend_Controller_Action
{
    protected $_mainRouter;

    protected $_template;

    protected $_logger;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter)) ) {
            throw New Zend_Exception('',Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->ContextSwitch()
        ->addActionContext('run-generic-code', 'json')
        ->addActionContext('run-specific-code', 'json')
        ->initContext('json');

        $this->_helper->layout->disableLayout();

        $this->_template = APPLICATION_PATH."/bin/template.php";
    }

    public function runGenericCodeAction()
    {
        $this->_runCode('generic', '');
    }

    public function runSpecificCodeAction()
    {
        $error = "";
        $inputMac = '<br/> Mac:<input type="text" name="mac" />';
        if ($this->getParam("exec")) {
            if($this->getParam("mac")){
                $terminalMapper = new IvozProvider\Mapper\Sql\Terminals();
                $terminalModel = $terminalMapper->findOneByField('mac', $this->getParam("mac"));
                if($terminalModel){
                    $this->view->terminal = $terminalModel;

                    $userMapper = new \IvozProvider\Mapper\Sql\Users();
                    $userModel = $userMapper->findOneByField('terminalId', $terminalModel->getId() );
                    $this->view->user = $userModel;

                    $companyModel = $terminalModel->getCompany();
                    $this->view->company = $companyModel;

                    $brandModel = $companyModel->getBrand();
                    $this->view->brand = $brandModel;
                } else {
                    $error = "Mac does not exist";
                }
                $this->_runCode('specific', $inputMac, $error );
            } else{
                $this->_runCode('specific', $inputMac, "*required");
            }
        } else {
            $this->_runCode('specific', $inputMac);
        }
    }

    protected function _runCode($type, $inputMac, $error = false)
    {
        $buttons = array();
        $id = $this->_mainRouter->getParam('pk', false);

        if ($id) {
            $terminalModelsMapper = new \IvozProvider\Mapper\Sql\TerminalModels();
            $terminalModelsModel = $terminalModelsMapper->find($id);

            if (($this->getParam("exec")) && !$error) {
                $path = $this->_getFilePath();
                $route = $path . DIRECTORY_SEPARATOR . "Provision_template" . DIRECTORY_SEPARATOR . $id;
                $filename = 'temporal-' . $type .'.php';
                $this->_createFile($route, $filename);

                $this->view->terminalModel = $terminalModelsModel;

                $var = base64_encode(serialize($this->view->getVars()));
                $command = "/usr/bin/php " . $route . DIRECTORY_SEPARATOR . $filename . " " . $var . " 2>&1";
                exec($command, $output, $resultCode);
                unlink($route . DIRECTORY_SEPARATOR . $filename);

                array_walk($output, function (&$value, $key) {
                    //Ensure xml's are readable in browser
                    $value = htmlentities($value);
                });

                $message = implode("<br>", $output);
            }
            else{
                $message = _('This template is going to be tested<br /><textarea name="currentCode" rows="8" cols="80" readonly></textarea>' . $inputMac . $error);
                $buttons = array(
                        _('Exec') => array(
                                'reloadParent' => false,
                                'recall' => true,
                                'params' => array('exec'=>true)
                        )
                );
            }
        } else {
            $message = _('The terminal model must be saved before you can test the code');
        }

        $this->_dispatch( $message, $buttons);
    }

    protected function _getFilePath(){
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $path = $conf->Iron['fso']['localStoragePath'];
        return $path;
    }

    protected function _createFile($route, $file){
        $filename = $route . DIRECTORY_SEPARATOR .$file;

        if (!file_exists($route)) {
            $old = umask(0);
            mkdir($route, 0777, true);
            umask($old);
        }

        // There is no SERVER_NAME in console commands, inject it
        $serverVars = '<?php $_SERVER["SERVER_NAME"] = "' . $_SERVER["SERVER_NAME"] . '"; ?>';
        $currentCode = $serverVars . $this->getParam("currentCode");

        $currentCodePost = " <?php  } }";
        try {
            if ( copy($this->_template, $filename)) {
                file_put_contents($filename, $currentCode . $currentCodePost, FILE_APPEND);
            } else{
                $this->_helper->log( "RunCode- error copy(" . $this->_template . ", " . $filename . ")", Zend_Log::ERR);
                file_put_contents($filename, "Internal error processing the code. Try it again later and if the problem persists, contact an administrator.");
            }
        } catch (Exception $e) {
            $this->_helper->log( "RunCode- " . $e->getMessage(), Zend_Log::WARN);
        }
    }

    protected function _dispatch( $message, $buttons = array()){
        $buttons[_('Close')] = array(
            'reloadParent' => false,
            'recall' => false,
        );
        $data = array(
            'title' => _("Test the code"),
            'message' => $message,
            'buttons'=>$buttons
        );

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customRunCode');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customRunCode.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
