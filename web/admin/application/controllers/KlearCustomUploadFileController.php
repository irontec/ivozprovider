<?php
class KlearCustomUploadFileController extends Zend_Controller_Action
{
    protected $_mainRouter;
    
    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter))) {
            throw new Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }
    
        $this->_helper->ContextSwitch()
             ->addActionContext('upload-file', 'json')
             ->initContext('json');
  
        $this->_helper->layout->disableLayout();
    }
    
    public function uploadFileAction()
    {
        
        $data = array(
                'title' => $this->_helper->translate("Import file"),
                'message'=>$this->_helper->translate("Select file to import") . "</br> <input type=\"file\">",
                'buttons'=>array(
                        $this->_helper->translate('Cancel') => array(
                                'reloadParent' => false,
                                'recall' => false,
                        )
                )
        );
        
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customTextFileReader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customTextFileReader.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
