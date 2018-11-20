<?php

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;

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

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto $modelFax */
        $modelFax = $dataGateway->find(
            FaxesInOut::class,
            $pk
        );

        if (!$modelFax) {
            $modelFax = FaxesInOut::createDto();
        }

        $bodyMsg = '
                <p><strong>'.$this->_helper->translate("Resend to").':</strong> '.$modelFax->getDst().'</p>
                <p><strong>'.$this->_helper->translate("File").':</strong> '.$modelFax->getFileBaseName().'</p>
        ';

        if ($this->getRequest()->getParam("forward")) {
            $modelFax->setStatus('pending');

            $dataGateway->update(
                FaxesInOut::class,
                $modelFax
            );

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
