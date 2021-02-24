<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddress;

class KlearCustomBruteForceUnbanController extends Zend_Controller_Action
{
    protected $_mainRouter;
    
    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter"))
            || (!is_object($this->_mainRouter))
        ) {
            throw new Zend_Exception(
                '',
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
        }

        $this->_helper
            ->ContextSwitch()
            ->addActionContext('index', 'json')
            ->initContext('json');
  
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        $pk = $this->getRequest()->getParam("pk");

        if ($this->getRequest()->getParam("apply")) {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            try {
                $dataGateway->remove(
                    BannedAddress::class,
                    [$pk]
                );

                $msg = $this->_helper->translate(
                    "Address successfully unbanned"
                );
            } catch (\Exception $e) {
                $msg = $this->_helper->translate(
                    "Problems unbanning address"
                );
            }

            $data = [
                'title' => $this->_helper->translate(
                    "Unbanned address"
                ),
                'message'=> $msg,
                'buttons' => [
                    $this->_helper->translate('Accept') => [
                        'reloadParent' => true,
                        'recall' => false,
                    ]
                ]
            ];
        } else {
            $data = [
                'title' => $this->_helper->translate(
                    "Unban address"
                ),
                'message'=> $this->_helper->translate(
                    'Do you really want to unban selected item?'
                ),
                'buttons' => [
                    $this->_helper->translate('Cancel') => [
                        'reloadParent' => false,
                        'recall' => false,
                    ],
                    $this->_helper->translate('Accept') => [
                        "recall" => true,
                        "reloadParent" => false,
                        "params" => [
                            "apply" => true
                        ]
                    ]
                ]
            ];
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
