<?php
class KlearCustomForwardFaxController extends Zend_Controller_Action
{
    protected $_mainRouter;
    
    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter)) ) {
            throw New Zend_Exception('',Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }
    
        $this->_helper->ContextSwitch()
             ->addActionContext('forward-fax', 'json')
             ->initContext('json');
  
      $this->_helper->layout->disableLayout();
    }
    
    public function forwardFaxAction()
    {
        $pk = $this->getRequest()->getParam("pk");

        $mapperFax = new IvozProvider\Mapper\Sql\FaxesInOut();
        $modelFax = $mapperFax->find($pk);

        if (!$modelFax) {
            $modelFax = new IvozProvider\Model\FaxesInOut();
        }

        $bodyMsg = '
                <p><strong>'.$this->_helper->translate("Resend to").':</strong> '.$modelFax->getDst().'</p>
                <p><strong>'.$this->_helper->translate("File").':</strong> '.$modelFax->getFileBaseName().'</p>
        ';

        if ($this->getRequest()->getParam("forward")) {
            $modelFax->setStatus('pending');
            $modelFax->save();

            $data = array(
                'title' => $this->_helper->translate("Fax resent"),
                'message'=> $bodyMsg,
                'buttons'=>array(
                    $this->_helper->translate('Accept') => array(
                        'reloadParent' => true,
                        'recall' => false,
                    )
                )
            );
        } else {
            $data = array(
                'title' => $this->_helper->translate("Resend fax"),
                'message'=> $bodyMsg,
                'buttons'=>array(
                    $this->_helper->translate('Cancel') => array(
                        'reloadParent' => false,
                        'recall' => false,
                    ),
                    $this->_helper->translate('Resend') => array(
                        "recall" => true,
                        "reloadParent" => false,
                        "params" => array(
                            "forward" => true
                        )
                    )
                )
            );
        }


        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customTextFileReader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customTextFileReader.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
